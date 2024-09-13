<?php

namespace App\Services;

use App\Mail\OrderInvoiceMail;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class OrderService
{

    public function generateInvoice() {
        $orders = $this->getOrders();
        $orderIds = $this->getOrderIdsFromCsv();

        $filteredOrders = $this->filterOrdersByNumbers($orders['orders'], $orderIds);

        foreach ($filteredOrders as $order) {
            $data = [
                'order_name' => $order['name'],
                'created_at' => $order['created_at'],
                'billing_address' => $order['billing_address'],
                'line_items' => $order['line_items'],
            ];

            try {
                $pdf = Pdf::loadView('invoices.order', $data);
                Mail::to($order['contact_email'])->send(new OrderInvoiceMail($pdf));
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        }
        return "Invoice succesfully sent!";
    }

    protected function getOrderIdsFromCsv() {
        $path = storage_path('app\csv\Orders.csv');

        if (file_exists($path)) {
            $orders = file_get_contents($path);

            $orderIds = explode(PHP_EOL, $orders);
            array_shift($orderIds);

            return $orderIds;
        }
    }

    protected function getOrders () {
        $client = new Client();

        $storeName = config('app.shopify.store');
        $accessToken = config('app.shopify.token');

        $response = $client->request('GET', "https://$storeName/admin/api/2024-07/orders.json?status=any", [
            'headers' => [
                'X-Shopify-Access-Token' => $accessToken,
                'Content-Type' => 'application/json'
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function filterOrdersByNumbers($orders, $orderNumbers) {
        return array_filter($orders, function($order) use ($orderNumbers) {
            return in_array($order['name'], $orderNumbers);
        });
    }
}

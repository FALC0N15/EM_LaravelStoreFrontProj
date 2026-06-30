<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productsByCategory = [
            'Technology' => [
                '8 GB RAM Stick', '16 GB RAM Stick', '32 GB RAM Stick', 'Mechanical Keyboard',
                'Wireless Mouse', '27" 4K Monitor', 'USB-C Hub', 'Webcam 1080p',
                'Noise Cancelling Headphones', 'Bluetooth Speaker', 'Portable SSD 1TB',
                'External Hard Drive 4TB', 'Laptop Stand', 'Phone Charging Cable',
                'Wireless Charger Pad', 'Gaming Mouse Pad', 'HDMI Cable 6ft',
                'Smart Light Bulb', 'WiFi Router', 'Power Bank 20000mAh',
            ],
            'Toys' => [
                'Polly Pocket Playset', 'Action Figure Set', 'Remote Control Car',
                'Building Blocks 500pc', 'Plush Teddy Bear', 'Puzzle 1000 Piece',
                'Board Game Classic', 'Yo-Yo Pro', 'Toy Drone', 'Water Gun Blaster',
                'Stuffed Animal Dog', 'Toy Train Set', 'Building Bricks Castle',
                'Doll House', 'Spinning Top Set', 'Card Game Pack',
                'Bouncy Ball Set', 'Toy Race Track', 'Building Blocks Robot',
                'Squishy Toy Pack',
            ],
            'Food' => [
                'KD Ramen', 'Instant Noodles 12-Pack', 'Trail Mix Bag', 'Granola Bars Box',
                'Coffee Beans 1lb', 'Green Tea Bags', 'Hot Sauce Bottle', 'Peanut Butter Jar',
                'Pasta Sauce Jar', 'Pasta Box', 'Rice 5lb Bag', 'Honey Jar',
                'Maple Syrup Bottle', 'Cereal Box', 'Protein Bars Box', 'Chips Variety Pack',
                'Cookies Pack', 'Chocolate Bar', 'Energy Drink 4-Pack', 'Sparkling Water 12-Pack',
            ],
            'Trading Cards' => [
                'Pokemon TCG: Booster Box', 'Pokemon TCG: Elite Trainer Box', 'Pokemon TCG: Single Booster Pack',
                'Magic the Gathering Booster Box', 'Yu-Gi-Oh Booster Box', 'Card Sleeves 100ct',
                'Card Binder 9-Pocket', 'Trading Card Display Case', 'Pokemon TCG: Battle Deck',
                'Magic the Gathering Bundle', 'Card Toploaders 25ct', 'Deck Box',
                'Pokemon TCG: Tin', 'Sports Card Pack', 'Card Grading Submission Kit',
                'Playmat', 'Card Sorting Tray', 'Booster Pack Bundle',
                'Trading Card Lot', 'Vintage Card Pack',
            ],
            'Home & Garden' => [
                'Ceramic Plant Pot', 'Garden Hose 50ft', 'LED Desk Lamp', 'Throw Pillow Set',
                'Area Rug 5x7', 'Wall Clock', 'Picture Frame Set', 'Candle Set',
                'Kitchen Towel Set', 'Cutting Board', 'Garden Gloves', 'Watering Can',
                'Outdoor String Lights', 'Storage Bin Set', 'Welcome Mat', 'Throw Blanket',
                'Vase Set', 'Wall Art Print', 'Plant Stand', 'Garden Trowel Set',
            ],
        ];

        foreach ($productsByCategory as $categoryName => $products) {
            $category = Category::where('category_name', $categoryName)->first();

            foreach ($products as $productName) {
                Product::create([
                    'product_name'        => $productName,
                    'product_description' => "This is a high quality {$productName} from our {$categoryName} collection. Great value and built to last.",
                    'product_price'       => rand(499, 29999) / 100,
                    'stock_quantity'      => rand(0, 100),
                    'category_id'         => $category->id,
                ]);
            }
        }
    }
}

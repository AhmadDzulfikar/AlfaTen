<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class FirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //USER
        User::create([
            "name" => "Mujahid",
            "email" => "mujahid@gmail.com",
            "username" => "mujahid",
            "password" => Hash::make("Mujahid"),
        ]);

        User::create([
            "name" => "Mujahid",
            "email" => "robbani@gmail.com",
            "username" => "robbani",
            "password" => Hash::make("robbani"),
        ]);

        User::create([
            "name" => "Sholahudin",
            "email" => "sholahudin@gmail.com",
            "username" => "sholahudin",
            "password" => Hash::make("sholahudin"),
        ]);
        //TUTUP USER

        //ROLE
        Role::create(["name" => "Customer"]);
        Role::create(["name" => "Cashier"]);
        Role::create(["name" => "Manager"]);
        //TUTUP ROLE

        //USER ROLE
        UserRole::create([
            "user_id" => 1,
            "role_id" => 3,
        ]);

        UserRole::create([
            "user_id" => 2,
            "role_id" => 1,
        ]);

        UserRole::create([
            "user_id" => 3,
            "role_id" => 2,
        ]);
        //TUTUP USER ROLE

        //CATEGORY
        Category::create(["name" => "Snacks"]);
        Category::create(["name" => "Foods & Goods"]);
        Category::create(["name" => "Drinks"]);
        Category::create(["name" => "Beauties"]);
        Category::create(["name" => "Medicine"]);
        //TUTUP CATEGORY

        //PRODUCTS
        Product::create([
            "name" => "Chitato",
            "price" => 11500,
            "thumbnail" => "chitato.jpg",
            "desc" => "makanan ringan dari kentang asli, renyah dan penuh rasa, diproses secara higienis dan modern tanpa bahan pengawet dan MSG.",
            "category_id" => 1,
        ]);

        Product::create([
            "name" => "Indomie Goreng",
            "price" => 3500,
            "thumbnail" => "indomie.png",
            "desc" => "Indomie Mi Goreng yaitu mi instan tanpa kuah yang sejenis dengan mi goreng tradisional yang bisa ditemui di restoran-restoran atau penjaja makanan di pinggiran jalan di Indonesia.",
            "category_id" => 2,
        ]);

        Product::create([
            "name" => "Pocari Sweat",
            "price" => 7000,
            "thumbnail" => "pocari.png",
            "desc" => "salah satu minuman isotonic yang mengandung berbagai ion penting untuk menggantikan cairan yang hilang dalam tubuh. ",
            "category_id" => 3,
        ]);

        Product::create([
            "name" => "Scarlett Whitening",
            "price" => 52000,
            "thumbnail" => "scarlett.jpg",
            "desc" => "berfungsi untuk mencerahkan dan melembabkan kulit, dengan kandungan Vit E dan Glutathione yg sudah terbukti dapat mencerahkan dan aman digunakan.",
            "category_id" => 4,
        ]);

        Product::create([
            "name" => "Bodrex",
            "price" => 5000,
            "thumbnail" => "bodrex.png",
            "desc" => "obat yang bermanfaat untuk meringankan sakit kepala, sakit gigi, dan demam.",
            "category_id" => 5,
        ]);
        // TUTUP PRODUCTS

        //STOCKS
        Stock::create([
            "product_id" => 1,
            "quantity" => 50,
            "expire_date" => "2023-05-01"
        ]);

        Stock::create([
            "product_id" => 2,
            "quantity" => 50,
            "expire_date" => "2023-05-01"
        ]);

        Stock::create([
            "product_id" => 3,
            "quantity" => 50,
            "expire_date" => "2023-05-01"
        ]);

        Stock::create([
            "product_id" => 4,
            "quantity" => 50,
            "expire_date" => "2023-05-01"
        ]);

        Stock::create([
            "product_id" => 5,
            "quantity" => 50,
            "expire_date" => "2023-05-01"
        ]);
        //TUTUP STOCKS

        //TRANSACTIONS
        Transaction::create([
            "product_id" => 1,
            "user_id" => 2,
            "quantity" => 3,
            "status" => "unpaid",
            "invoice_code" => "INV_32301"
        ]);

        Transaction::create([
            "product_id" => 2,
            "user_id" => 2,
            "quantity" => 5,
            "status" => "unpaid",
            "invoice_code" => "INV_32301"
        ]);

        Transaction::create([
            "product_id" => 3,
            "user_id" => 2,
            "quantity" => 1,
            "status" => "unpaid",
            "invoice_code" => "INV_32301"
        ]);

        Transaction::create([
            "product_id" => 4,
            "user_id" => 2,
            "quantity" => 1,
            "status" => "unpaid",
            "invoice_code" => "INV_32301"
        ]);

        Transaction::create([
            "product_id" => 5,
            "user_id" => 2,
            "quantity" => 3,
            "status" => "unpaid",
            "invoice_code" => "INV_32301"
        ]);
        //TUTUP TRANSACTIONS

        //DISCOUNTS
        Discount::create([
            "product_id" => 4,
            "percentage" => 10,
            "start_date" => "2022-08-01",
            "end_date" => "2022-08-30",
        ]);

        Discount::create([
            "product_id" => 3,
            "percentage" => 5,
            "start_date" => "2022-08-01",
            "end_date" => "2022-08-15",
        ]);
        //TUTUP DISCOUNTS

    }
}

<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $basic = ["Hosting", "Domain", "Kuota Bandwith", "SSL Sertifikat", "Desain Website (4 Halaman)", "Responsive Layout", "Desain UI/UX (Template)", "Frontend (HTML)", "Backend (PHP / Laravel)", "-", "-", "-", "-", "-", "-",];
        $silver = [
            "Hosting",
            "Domain",
            "Kuota Bandwith",
            "SSL Sertifikat",
            "Desain Website (6 Halaman)",
            "Responsive Layout",
            "Desain UI/UX (Figma)",
            "Frontend (HTML)",
            "Backend (PHP / Laravel)",
            "Setup Webmail",
            "Ads Facebook/Instagram",
            "SEO Friendly",
            "Mockup Wireframe",
            "Content Management System",
            "User Role Manager",
        ];
        $gold = [
            "Hosting",
            "Domain",
            "Kuota Bandwith",
            "SSL Sertifikat",
            "Desain Website (8 Halaman)",
            "Responsive Layout",
            "Desain UI/UX (Figma)",
            "Frontend (HTML/Vue Js)",
            "Backend (Laravel/Node Js/Golang)",
            "Setup Webmail",
            "Ads Facebook/Instagram, Ads Google",
            "SEO Friendly",
            "Mockup Wireframe",
            "Content Management System",
            "User Role Manager"
        ];
        $custom = [
            "Wujudkan website impian dengan teknologi yang Anda harapkan",
            "HTML",
            "CSS",
            "JavaScript",
            "PHP",
            "Wordpress",
            "MySql",
            "Postgresql",
            "Golang",
            "ReactJs",
            "Firebase",
            "Socket.io",
            "Strapi",
        ];

        Package::create([
            "name" => "Basic",
            "price" => "2999000",
            "details" => $basic,
        ]);
        Package::create([
            "name" => "Silver",
            "price" => "9599000",
            "details" => $silver,
        ]);
        Package::create([
            "name" => "Gold",
            "price" => "13499000",
            "details" => $gold,
        ]);
        Package::create([
            "name" => "Custom",
            "price" => "Sesuai kesepakatan",
            "details" => $custom,
        ]);
    }
}

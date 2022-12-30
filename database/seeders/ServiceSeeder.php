<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceDetail;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            0 => [
                "title" => "IT Consultant",
                "user_id" => 1,
                "slug" => "it-consultant",
                "body" => "Kami siap membantu Jasa Pembuatan Website. Konsultasi seputar custom website development untuk perusahaan Anda!",
                "image" => " ",
            ],
            1 => [
                "title" => "Mobile App Development ",
                "user_id" => 1,
                "slug" => "mobile-development",
                "body" => "Kami siap membantu Jasa Pembuatan Website. Konsultasi seputar custom website development untuk perusahaan Anda!",
                "image" => " ",
            ],
            2 => [
                "title" => "Web App Development",
                "user_id" => 1,
                "slug" => "WebApp-development",
                "body" => "Kami siap membantu Jasa Pembuatan Website. Konsultasi seputar custom website development untuk perusahaan Anda!",
                "image" => " ",

            ],
            3 => [
                "title" => "Website Development ",
                "user_id" => 1,
                "slug" => "website-development",
                "body" => "Kami siap membantu Jasa Pembuatan Website. Konsultasi seputar custom website development untuk perusahaan Anda!",
                "image" => " ",
            ],
        ];

        $detail = [
            [
                "service_id" => 1,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 1,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 1,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 1,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 1,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 1,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 1,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            // 2
            [
                "service_id" => 2,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 2,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 2,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 2,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 2,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 2,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 2,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            // 3
            [
                "service_id" => 3,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 3,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 3,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 3,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 3,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 3,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 3,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            // 4
            [
                "service_id" => 4,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 4,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 4,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 4,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 4,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 4,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
            [
                "service_id" => 4,
                "title" => "IT Consultant",
                "body" => "Ceritakan makna dibalik brand Anda, kebutuhan, serta tantangan yang sedang dihadapi. Proses pengembangan website akan kami mulai dari situ",
                "image" => " "
            ],
        ];

        foreach ($data as $key => $value) {
            Service::create($value);
        }

        foreach ($detail as $d) {
            ServiceDetail::create($d);
        }
    }
}

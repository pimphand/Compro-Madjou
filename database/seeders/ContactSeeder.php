<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'name'  => 'gmaps',
            'images' => '',
            'url'   => '',
        ]);
        
        Contact::create([
            'name'  => 'instagram',
            'images' => '',
            'url'   => 'https://www.instagram.com/themadjou/'
        ]);

        Contact::create([
            'name'  => 'facebook',
            'images' => '',
            'url'   => 'https://www.facebook.com/profile.php?id=100085220725132'
        ]); 
        Contact::create([
            'name'      => 'linkedin',
            'images'     => '',
            'url'       => 'https://www.linkedin.com/company/themadjou/',
        ]);  
        Contact::create([
            'name'      => 'email',
            'images'     => '',
            'url'       => 'info@madjou.com'
        ]); 
        Contact::create([
            'name'      => 'whatsapp',
            'images'     => '',
            'url'       => 'https://api.whatsapp.com/send?phone=6282141217580&text=Halo,%20Saya%20ingin%20konsultasi%20dengan%20Madjou%20terkait%20rencana%20digitalisasi/%20Hello,%20I%20would%20like%20to%20consult%20with%20Madjou%20regarding%20the%20digitization%20plan'
        ]);
    }
}

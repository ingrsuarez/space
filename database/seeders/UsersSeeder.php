<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        if(!(User::find(48)))
        {
            $vanina = new User();

            $vanina->id = 48;
            $vanina->name = 'quintana vanina';
            $vanina->email = 'vavequ@hotmail.com';
            $vanina->password = bcrypt('space');
            $vanina->email_verified_at = '2023-05-11 12:33:15';
            $vanina->tipo = 2;
            $vanina->estado = 'activo';

            $vanina->save();
        }

        if(!(User::find(57)))
        {
            $bacci = new User();

            $bacci->id = 57;
            $bacci->name = 'bacci viviana esther';
            $bacci->email = 'baccivivianaesther@gmail.com';
            $bacci->password = bcrypt('space');
            $bacci->email_verified_at = '2023-05-11 12:33:15';
            $bacci->tipo = 2;
            $bacci->estado = 'activo';

            $bacci->save();
        }

        if(!(User::find(17)))
        {
            $rodrigo = new User();

            $rodrigo->id = 17;
            $rodrigo->name = 'suarez rodrigo';
            $rodrigo->email = 'ing.rsuarez@gmail.com';
            $rodrigo->password = bcrypt('space');
            $rodrigo->email_verified_at = '2023-05-11 12:33:15';
            $rodrigo->tipo = 1;
            $rodrigo->estado = 'activo';

            $rodrigo->save();
        }

        if(!(User::find(60)))
        {
            $rocio = new User();

            $rocio->id = 60;
            $rocio->name = 'giuliana rocio';
            $rocio->email = 'roo_giuliana94@live.com.ar';
            $rocio->password = bcrypt('space');
            $rocio->email_verified_at = '2023-05-11 12:33:15';
            $rocio->tipo = 3;
            $rocio->estado = 'activo';

            $rocio->save();
        }
        

        if(!(User::find(62)))
        {
            $viola = new User();

            $viola->id = 62;
            $viola->name = 'viola celeste';
            $viola->email = 'celeviola@hotmail.com';
            $viola->password = bcrypt('space');
            $viola->email_verified_at = '2023-05-11 12:33:15';
            $viola->tipo = 2;
            $viola->estado = 'activo';

            $viola->save();
        }

        if(!(User::find(64)))
        {
            $viola = new User();

            $viola->id = 64;
            $viola->name = 'martinez azucena';
            $viola->email = 'maravillosaafm@gmail.com';
            $viola->password = bcrypt('space');
            $viola->email_verified_at = '2023-05-11 12:33:15';
            $viola->tipo = 2;
            $viola->estado = 'activo';

            $viola->save();
        }
        
        if(!(User::find(49)))
        {
            $sofia = new User();

            $sofia->id = 49;
            $sofia->name = 'tognonato sofia';
            $sofia->email = 'sofitogno@yahoo.com.ar';
            $sofia->password = bcrypt('space');
            $sofia->email_verified_at = '2023-05-11 12:33:15';
            $sofia->tipo = 2;
            $sofia->estado = 'activo';

            $sofia->save();
        }
        
        if(!(User::find(58)))
        {
            $mariela = new User();

            $mariela->id = 58;
            $mariela->name = 'ibrahim mariela';
            $mariela->email = 'maibrahim@hotmail.com';
            $mariela->password = bcrypt('space');
            $mariela->email_verified_at = '2023-05-11 12:33:15';
            $mariela->tipo = 2;
            $mariela->estado = 'activo';

            $mariela->save();
        }

        if(!(User::find(66)))
        {
            $cifuentes = new User();

            $cifuentes->id = 66;
            $cifuentes->name = 'cifuentes rosa';
            $cifuentes->email = 'roco6020@gmail.com';
            $cifuentes->password = bcrypt('space');
            $cifuentes->email_verified_at = '2023-05-11 12:33:15';
            $cifuentes->tipo = 2;
            $cifuentes->estado = 'activo';

            $cifuentes->save();
        }

        if(!(User::find(67)))
        {
            $moreno = new User();

            $moreno->id = 67;
            $moreno->name = 'moreno walter';
            $moreno->email = 'walterfabianmoreno12@gmail.com';
            $moreno->password = bcrypt('space');
            $moreno->email_verified_at = '2023-05-11 12:33:15';
            $moreno->tipo = 2;
            $moreno->estado = 'activo';

            $moreno->save();
        }
    }
}

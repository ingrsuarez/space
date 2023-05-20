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
            $vanina->name = 'vanina';
            $vanina->lastName = 'quintana';
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
            $bacci->name = 'viviana esther';
            $bacci->lastName = 'bacci';
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
            $rodrigo->name = 'rodrigo';
            $rodrigo->lastName = 'suarez';
            $rodrigo->email = 'ing.rsuarez@gmail.com';
            $rodrigo->password = bcrypt('space');
            $rodrigo->email_verified_at = '2023-05-11 12:33:15';
            $rodrigo->tipo = 1;
            $rodrigo->estado = 'activo';
            $rodrigo->assignRole('profesional', 'admin');

            $rodrigo->save();
        }

        if(!(User::find(60)))
        {
            $rocio = new User();

            $rocio->id = 60;
            $rocio->name = 'rocio';
            $rocio->lastName = 'giuliana';
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
            $viola->name = 'celeste';
            $viola->lastName = 'viola';
            $viola->email = 'celeviola@hotmail.com';
            $viola->password = bcrypt('space');
            $viola->email_verified_at = '2023-05-11 12:33:15';
            $viola->tipo = 2;
            $viola->estado = 'activo';

            $viola->save();
        }

        if(!(User::find(64)))
        {
            $martinez = new User();

            $martinez->id = 64;
            $martinez->name = 'azucena';
            $martinez->lastName = 'martinez';
            $martinez->email = 'maravillosaafm@gmail.com';
            $martinez->password = bcrypt('space');
            $martinez->email_verified_at = '2023-05-11 12:33:15';
            $martinez->tipo = 2;
            $martinez->estado = 'activo';

            $martinez->save();
        }
        
        if(!(User::find(49)))
        {
            $sofia = new User();

            $sofia->id = 49;
            $sofia->name = 'sofia';
            $sofia->lastName = 'tognonato';
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
            $mariela->name = 'mariela';
            $mariela->lastName = 'ibrahim';
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
            $cifuentes->name = 'rosa';
            $cifuentes->lastName = 'cifuentes';
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
            $moreno->name = 'walter';
            $moreno->lastName = 'moreno';
            $moreno->email = 'walterfabianmoreno12@gmail.com';
            $moreno->password = bcrypt('space');
            $moreno->email_verified_at = '2023-05-11 12:33:15';
            $moreno->tipo = 2;
            $moreno->estado = 'activo';

            $moreno->save();
        }
        
        if(!(User::find(51)))
        {
            $marina = new User();

            $marina->id = 51;
            $marina->name = 'marina grisel';
            $marina->lastName = 'croci';
            $marina->email = 'marinagrisel22@hotmail.com';
            $marina->password = bcrypt('space');
            $marina->email_verified_at = '2023-05-11 12:33:15';
            $marina->tipo = 2;
            $marina->estado = 'activo';

            $marina->save();
        }

        if(!(User::find(52)))
        {
            $andres = new User();

            $andres->id = 52;
            $andres->name = 'andres';
            $andres->lastName = 'lorenzo';
            $andres->email = 'anl79a@yahoo.com.ar';
            $andres->password = bcrypt('space');
            $andres->email_verified_at = '2023-05-11 12:33:15';
            $andres->tipo = 2;
            $andres->estado = 'activo';

            $andres->save();
        }

        if(!(User::find(53)))
        {
            $silvina = new User();

            $silvina->id = 53;
            $silvina->name = 'silvina';
            $silvina->lastName = 'sapienza';
            $silvina->email = 'silvina.sapienza@gmail.com';
            $silvina->password = bcrypt('space');
            $silvina->email_verified_at = '2023-05-11 12:33:15';
            $silvina->tipo = 2;
            $silvina->estado = 'activo';

            $silvina->save();
        }

        if(!(User::find(54)))
        {
            $carolina = new User();

            $carolina->id = 54;
            $carolina->name = 'carolina';
            $carolina->lastName = 'dioverti';
            $carolina->email = 'carodiov@hotmail.com';
            $carolina->password = bcrypt('space');
            $carolina->email_verified_at = '2023-05-11 12:33:15';
            $carolina->tipo = 2;
            $carolina->estado = 'activo';

            $carolina->save();
        }
        
        if(!(User::find(55)))
        {
            $leila = new User();

            $leila->id = 55;
            $leila->name = 'leila';
            $leila->lastName = 'dipp';
            $leila->email = 'dipplei@hotmail.com';
            $leila->password = bcrypt('space');
            $leila->email_verified_at = '2023-05-11 12:33:15';
            $leila->tipo = 2;
            $leila->estado = 'activo';

            $leila->save();
        }
        if(!(User::find(56)))
        {
            $leila = new User();

            $leila->id = 56;
            $leila->name = 'andres felipe ';
            $leila->lastName = 'cordoba arias';
            $leila->email = 'pipe198@live.com';
            $leila->password = bcrypt('space');
            $leila->email_verified_at = '2023-05-11 12:33:15';
            $leila->tipo = 2;
            $leila->estado = 'activo';

            $leila->save();
        }

        if(!(User::find(59)))
        {
            $marcelo = new User();

            $marcelo->id = 59;
            $marcelo->name = 'marcelo hugo';
            $marcelo->lastName = 'gutierrez';
            $marcelo->email = 'marcelo.gutierrez.ml@gmail.com';
            $marcelo->password = bcrypt('space');
            $marcelo->email_verified_at = '2023-05-11 12:33:15';
            $marcelo->tipo = 2;
            $marcelo->estado = 'activo';

            $marcelo->save();
        }

        if(!(User::find(61)))
        {
            $malano = new User();

            $malano->id = 61;
            $malano->name = 'martin';
            $malano->lastName = 'malano';
            $malano->email = 'malanotincho@hotmail.com';
            $malano->password = bcrypt('space');
            $malano->email_verified_at = '2023-05-11 12:33:15';
            $malano->tipo = 2;
            $malano->estado = 'activo';

            $malano->save();
        }        
    }
}

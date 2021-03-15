<?php
namespace Database\Seeders;

use App\Models\Empresas;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rafael = User::create(['name' => 'Rafael Hasson', 'email' => 'rafael@connectplug.com.br', 'password' => bcrypt('123123')]);
        $marlon = User::create(['name' => 'Marlon Minotti', 'email' => 'marlon.minotti@gmail.com', 'password' => bcrypt('123123')]);
        $alex = User::create(['name' => 'Alex Vendedor', 'email' => 'vendedor1@connectplug.com.br', 'password' => bcrypt('123123')]);

        $emp1 = Empresas::create(['nome' => 'ConnectPlug']);
        $emp2 = Empresas::create(['nome' => 'ConnectPlug Filial']);

        $gerente = Role::find(1);

        if (!$gerente) {
            $gerente = new Role();
            $gerente->name = 'gerente';
            $gerente->display_name = 'Quem possuir esta regra tem acesso total ao sistema';
            $gerente->save();
        }

        $vendedor = Role::find(2);

        if (!$vendedor) {
            $vendedor = new Role();
            $vendedor->name = 'vendedor';
            $vendedor->display_name = 'Apenas lista os produtos';
            $vendedor->save();
        }

        $rafael->attachRole($gerente);
        $rafael->empresa_id = 1;
        $rafael->empresas()->saveMany([$emp1, $emp2]);
        $rafael->save();

        $marlon->attachRole($gerente);
        $marlon->empresa_id = 1;
        $marlon->empresas()->saveMany([$emp1, $emp2]);
        $marlon->save();

        $alex->attachRole($vendedor);
        $alex->empresa_id = 2;
        $alex->empresas()->saveMany([$emp2]);
        $alex->save();

    }
}

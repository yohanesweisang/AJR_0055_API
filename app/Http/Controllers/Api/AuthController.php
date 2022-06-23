<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use App\Models\Customer;
    use App\Models\Pegawai;
    use App\Models\Driver;
    use Validator;


class AuthController extends Controller
{
    public function login(Request $request){
        $loginData = $request->all();
        $validate = Validator::make($loginData,[
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);
    
        if($validate->fails())
        return response(['message' => $validate->errors()],400);
    
        if($Customer = Customer::where('email_customer', '=', $loginData['email'])->first()){
            $cekPass = Hash::check($loginData['password'], $Customer->PASSWORD_CUSTOMER);
            
            if($cekPass){
                $data = Customer::where('email_customer', $loginData['email'])->first();
                return response([
                    'message' => 'Customer Authenticated',
                    'data' => $data
                    ]);
            } 
            else 
            {
                return response([
                    'message' => 'Password Customer Salah',
                    'data' => null
                ]);
            }
        } 
        else if($Pegawai = Pegawai::where('email_pegawai', '=', $loginData['email'])->where('id_role', '=', 1)->where('status_pegawai', '!=', "Tidak Aktif")->first()){
            $cekPass = Hash::check($loginData['password'], $Pegawai->PASSWORD_PEGAWAI);  

            if($cekPass){
                $data = Pegawai::where('email_pegawai', $loginData['email'])->first();
                return response([
                    'message' => 'Manager Authenticated',
                    'data' => $data
                    ]);
            } 
            else 
            {
                return response([
                    'message' => 'Password Pegawai Salah',
                    'data' => null
                ]);
            }
        }
        else if($Driver = Driver::where('email_driver', '=', $loginData['email'])->first()){
            $cekPass = Hash::check($loginData['password'], $Driver->PASSWORD_DRIVER); 
            
            if($cekPass){
                $data = Driver::where('email_driver', $loginData['email'])->first();
                return response([
                    'message' => 'Driver Authenticated',
                    'data' => $data
                    ]);
            } 
            else 
            {
                return response([
                    'message' => 'Password Driver Salah',
                    'data' => null
                ]);
            }
        }
        else
        {
            return response([
                'message' => 'Email Kurang Tepat',
                'data' => null
            ]);
        }
    }
}
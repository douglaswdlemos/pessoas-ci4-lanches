<?php

namespace App\Controllers;

use App\Models\PessoaModel;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Database\Query;
use RuntimeException;


class Upload extends BaseController
{
   public function index()
   {
      return view('upload_form');
   }

   public function file_upload()
   {

      helper(['form', 'url']);
      if ($this->request->getMethod() == 'post') {
         $rota = 'uploads/';
         $file = $this->request->getFile('file_excel');
         if (!$file->isValid()) {
            throw new RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
         } else {
            $name_file = $file->getName();
            $file->move($rota, $name_file);
            if ($file->hasMoved()) {


               $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($rota . $name_file);
               $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

               $spreadsheet = $reader->load($rota . $name_file);
               unlink($rota . $name_file);
               $data = $spreadsheet->getActiveSheet()->toArray();
               $variaveis['upload_data'] = $data;


               $pessoaModel = model('App\Models\PessoaModel');
               $isFirst = true;
               foreach ($data as $row) {
                  if ($isFirst) {
                     $isFirst = false;
                     continue;
                  } else {

                     $dataPessoa = [
                        'id' => $row[0],
                        'nome' => $row[1],
                        'altura' => str_replace(",", ".", $row[2]),
                        'lactose' => $row[3],
                        'peso' => str_replace(",", ".", $row[4]),
                        'atleta' => $row[5]
                     ];
                     $pessoaModel->insert($dataPessoa);
                  }
               }




               return view('upload_sucess');
            }
         }
      } else {
         return view('upload_form');
      }
   }
   public function show()
   {
      $db = db_connect();
      $request = \Config\Services::request();
      $draw   = intval($request->getVar('draw'));
      $start  = intval($request->getVar('start'));
      $length = intval($request->getVar('length'));
      $order = $request->getVar('order');
      $search = $request->getVar('search');
      $search = $search['value'];

      $col = 0;
      $dir = "";
      $name_col = "";
      $valid_col = array(
         0 => 'id',
         1 => 'nome',
         2 => 'altura',
         3 => 'altura',
         4 => 'lactose',
         5 => 'peso',
         6 => 'peso',
         7 => 'atleta',
      );

      if (!empty($order)) {
         foreach ($order as $o) {
            $col = $o['column'];
            $dir = $o['dir'];
         }
      }

      if ($dir != 'asc' && $dir != 'desc') {
         $dir = 'asc';
      }

      if (!isset($valid_col[$col])) {
         $order = null;
      } else {
         $order = $valid_col[$col];
      }

      $pessoaModel = model('App\Models\PessoaModel');

      $builder = $db->table('pessoas');
      $builder->orderBy($order, $dir);

      if (!empty($search)) {
         $x = 0;
         foreach ($valid_col as $sterm) {

            switch ($x) {
               case 0:
                  $builder->like($sterm, $search);
                  break;
               case 3:
                  break;
               case 6:
                  break;
               case 7:
                  break;
               default:
                  $builder->orlike($sterm, $search);
            }

            $x++;
         }
      }



      $query = $builder->get($length, $start);
      if (!empty($query)) {
         foreach ($query->getResult() as $pessoa) {
            $classe_altura = "";
            $lactose = "";
            $classe_peso = "";
            $atleta = "";
            /*Verifica Altura*/
            if ($pessoa->altura >= 1.80) {
               $classe_altura = "Altos";
            } else {
               if ($pessoa->altura >= 1.60 && $pessoa->altura <= 1.79) {
                  $classe_altura = "Medianos";
               } else {
                  if ($pessoa->altura <= 1.59) {
                     $classe_altura = "Baixos";
                  }
               }
            }
            /*Verifica Lactose*/
            if ($pessoa->lactose == 1) {
               $lactose = "Intolerante";
            } else {
               $lactose = "Normal";
            }
            /*Verifica Peso*/
            if ($pessoa->peso >= 90) {
               $classe_peso = "Acima do peso";
            } else {
               if ($pessoa->peso >= 70 and $pessoa->peso < 90) {
                  $classe_peso = "Peso ideal";
               } else {
                  if ($pessoa->peso < 70) {
                     $classe_peso = "Abaixo do peso";
                  }
               }
            }
            /*Verifica Atleta */
            if ($pessoa->atleta == 1) {
               $atleta = "Atleta";
            } else {
               $atleta = "Sedentário";
            }

            $json[] = array(
               $pessoa->id,
               $pessoa->nome,
               $pessoa->altura,
               $classe_altura,
               $lactose,
               $pessoa->peso,
               $classe_peso,
               $atleta,
               '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M18.6342 0.605251C17.8283 -0.20175 16.5149 -0.20175 15.709 0.605251L15.2852 1.02211L19.0162 4.75249L19.3668 4.39976C19.775 3.99359 20 3.4538 20 2.87127C20 2.28873 19.775 1.74895 19.372 1.34278L18.6342 0.605251Z" fill="black"/>
               <path d="M13.4119 2.88729L17.1429 6.61765L18.268 5.50068L14.5369 1.77032L13.4119 2.88729Z" fill="black"/>
               <path d="M1.76871 14.49L0 20L5.5102 18.2043L16.3946 7.3659L12.6635 3.63553L1.76871 14.49Z" fill="black"/>
               </svg>
               ' .
                  '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M17.1872 1.47368H12.9091V1.43158C12.9091 0.631579 12.2674 0 11.4545 0H8.54545C7.73262 0 7.09091 0.631579 7.09091 1.43158V1.47368H2.81283C2.36364 1.47368 2 1.83158 2 2.27368V3.07368C2 3.51579 2.36364 3.87368 2.81283 3.87368H17.1872C17.6364 3.87368 18 3.51579 18 3.07368V2.27368C18 1.83158 17.6364 1.47368 17.1872 1.47368Z" fill="black"/>
                  <path d="M16.1176 4.96841H3.88232C3.64702 4.96841 3.4759 5.15789 3.49729 5.38947L4.09622 17.5789C4.16039 18.9263 5.29408 20 6.66306 20H13.3155C14.6845 20 15.8181 18.9474 15.8823 17.5789L16.4812 5.38947C16.524 5.17894 16.3315 4.96841 16.1176 4.96841ZM8.67376 16.7368C8.67376 17.1158 8.37429 17.4105 7.98927 17.4105C7.60424 17.4105 7.30478 17.1158 7.30478 16.7368V8.25262C7.30478 7.87368 7.60424 7.57894 7.98927 7.57894C8.37429 7.57894 8.67376 7.87368 8.67376 8.25262V16.7368ZM12.6951 16.7368C12.6951 17.1158 12.3957 17.4105 12.0107 17.4105C11.6256 17.4105 11.3262 17.1158 11.3262 16.7368V8.25262C11.3262 7.87368 11.6256 7.57894 12.0107 7.57894C12.3957 7.57894 12.6951 7.87368 12.6951 8.25262V16.7368Z" fill="black"/>
                  </svg>'.'<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.1951 10.1429C12.1951 11.3333 11.2195 12.2857 10 12.2857C8.78049 12.2857 7.80488 11.3333 7.80488 10.1429C7.80488 8.95238 8.78049 8 10 8C11.2195 8 12.1951 8.95238 12.1951 10.1429ZM17.8049 8C16.5854 8 15.6098 8.95238 15.6098 10.1429C15.6098 11.3333 16.5854 12.2857 17.8049 12.2857C19.0244 12.2857 20 11.3333 20 10.1429C20 8.95238 19.0244 8 17.8049 8ZM2.19512 8C0.97561 8 0 8.95238 0 10.1429C0 11.3333 0.97561 12.2857 2.19512 12.2857C3.41463 12.2857 4.39024 11.3333 4.39024 10.1429C4.39024 8.95238 3.41463 8 2.19512 8Z" fill="black"/>
                  </svg>
                  '
                  
            );
         }

         $total_records = $pessoaModel->countAllResults();
         $response = array(
            'draw' => $draw,
            'recordsTotal' => $total_records,
            'recordsFiltered' => $total_records,
            'data' => $json
         );        
         echo json_encode($response);
      } else {
         $response = array();
         $response['sEcho'] = 0;
         $response['iTotalRecords'] = 0;
         $response['iTotalDisplayRecords'] = 0;
         $response['aaData'] = [];
         echo json_encode($response);
      }
   }
}

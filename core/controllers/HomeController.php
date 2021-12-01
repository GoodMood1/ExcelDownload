<?php
namespace Core\Controllers;

use Core\Helpers\View;
use Core\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HomeController extends Controller{

    public function index()
    {
        $title = 'Main page';
        $latestNew = [
            'title' => 'Dog',
            'content' => 'Lorem ipsum dolor'
        ];

        View::render('home', compact('title', 'latestNew'));
    }
 
    public function getPdf(){
        $users = User::all();
        $html = '<table border="1">';
        foreach($users as $user){
            $html .= '<tr>';
            $html .= "<td>{$user->id}</td>";
            $html .= "<td>{$user->fullname}</td>";
            $html .= "<td>{$user->email}</td>";
            $html .= "<td>" . date('d.m.Y', strtotime($user->created_at)) . "</td>";
            $html .= '</tr>';
        }
        $html .= '</table>';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('users.pdf','D');
    }
    public function getExcel(){
        $users = User::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setAutoSize(true); 
        $sheet->getColumnDimension('B')->setAutoSize(true); 
        $sheet->getColumnDimension('C')->setAutoSize(true); 
        $sheet->getColumnDimension('D')->setAutoSize(true); 
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Date');
        $i=2;
        foreach($users as $user){
            $sheet->setCellValue('A'.$i, $user->id);
            $sheet->setCellValue('B'.$i, $user->fullname);
            $sheet->setCellValue('C'.$i, $user->email);
            $sheet->setCellValue('D'.$i, date('d.m.Y', strtotime($user->created_at)));
            $i++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }
   


    public function contacts()
    {
        // вывести форму Обратной связи (Имя, email, тест сообщения)
        View::render('contacts');
    }


    public function sendMail()
    {
       // получить POST
       // отправить почту mail()
       // перенаправить поль-ля на главную страницу

       $name = $_POST['name'];
      // mail($to, $subj, $name)
     // self::redirect('/');
    }

}
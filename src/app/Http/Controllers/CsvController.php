<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CsvController extends Controller
{
   // 一覧表示処理
  public function csv_index(Request $request){

    $data = DB::table('users')->get(); // データ登録対象のテーブルからデータを取得する
    $count = $request->input('count'); // 何件登録したか結果を返す
    return view('csv_index',['data' => $data,'cnt' => $count]);
  }


  // CSVアップロード〜DBインポート処理
  public function upload(Request $request) {

    // 一旦アップロードされたCSVファイルを受け取り保存する
    $uploaded_file = $request->file('csvdata'); // inputのnameはcsvdataとする 
    $orgName = date('YmdHis') ."_".$request->file('csvdata')->getClientOriginalName();
    $spath = storage_path('app\\');
    $path = $spath.$request->file('csvdata')->storeAs('',$orgName);

    // CSVファイル（エクセルファイルも可）を読み込む
    //$result = (new FastExcel)->importSheets($path); //エクセルファイルをアップロードする時はこちら
    $result = (new FastExcel)->configureCsv(',')->importSheets($path); // カンマ区切りのCSVファイル時

    // DB登録処理
    $count = 0; // 登録件数確認用
    foreach ($result as $row) {
      foreach($row as $item){
        // ここでCSV内データとテーブルのカラムを紐付ける（左側カラム名、右側CSV１行目の項目名）
        $param = [
          'name' => '"'.$item["name"].'"',
          'area' => '"'.$item["area"].'"',
          'genre' => '"'.$item["genre"].'"',
          'image_url' => '"'.$item["image_url"].'"',
        ];
        // 次にDBにinsertする（更新フラグなどに対応するため１行ずつinsertする）
        DB::table('shops')->insert($param);
        $count++;
      }
    }
    return redirect(route('csv_index',['count' => $count]));
  }
}


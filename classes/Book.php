<?php

class Book extends BaseModel {

  public function getAllCurrentBooks($origin){
    $week_start = date('Y-m-d', strtotime('monday this week'));
    $week_end = date('Y-m-d', strtotime('sunday this week'));

    $all_records = DB::query("SELECT DATE(actions.created_at) as day, actions.id as action_id, books.book_title,COUNT(DISTINCT book_id) as total FROM `actions` LEFT JOIN books on books.id = actions.book_id WHERE actions.created_at>='$week_start' AND actions.created_at <='$week_end' AND books.book_origin='$origin' GROUP BY DAY(actions.created_at) ")
                      ->get();

    // Set record by Day key
    $all_records = $this->setRecordKey($all_records);
    // Get Missing Dates
    $all_records = $this->getMissingDayRecords($all_records);

    return $all_records;
  }

  public function getAllCompletedBooks($origin){
    $week_start = date('Y-m-d', strtotime('monday this week'));
    $week_end = date('Y-m-d', strtotime('sunday this week'));

    $completed_records = DB::query("SELECT DATE(actions.created_at) as day, actions.id as action_id, books.book_title,COUNT(DISTINCT book_id) as total FROM `actions` LEFT JOIN books on books.id = actions.book_id WHERE actions.created_at>='$week_start' AND actions.created_at <='$week_end' AND books.status_id=12 AND books.book_origin='$origin' GROUP BY DAY(actions.created_at) ")
                      ->get();

    // Set record by Day key
    $completed_records = $this->setRecordKey($completed_records);
    // Get Missing Dates
    $completed_records = $this->getMissingDayRecords($completed_records);

    return $completed_records;
  }

  public function getMissingDayRecords($records){
    $all_records = [];
    $month_start = date('Y-m-d', strtotime('monday this week'));
    $month_end = date('Y-m-d', strtotime('sunday this week'));

    $interval  = new \DateInterval('P1D');
    $date_start = date_create($month_start);
    $date_end = date_create($month_end);
    $date_end->modify('+1 day');

    $period    = new \DatePeriod($date_start, $interval, $date_end);

    $missingDates = [];
    foreach($period as $day) {
      $formatted = $day->format("Y-m-d");
      //if(!in_array($formatted, $dates)) $missingDates[] = $formatted;
      if(!array_key_exists($formatted,$records)){
        $records[$formatted] = false;
      }
    }

    //Sort it by key
    ksort($records);

    return $records;
  }

  public function setRecordKey($records){
    $new_records = [];
    foreach($records as $record){
      $new_records[$record['day']] = $record;
    }
    return $new_records;
  }

  public function countTotal($records){
    $total = 0;
    foreach($records as $record){
      $total += $record['total'];
    }
    return $total;
  }
}

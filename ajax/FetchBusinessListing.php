<?php
include('../config/connection.php');

$limit = $_POST['length'];
$start = $_POST['start'];
$search = $_POST['search']['value'];

$sql = "SELECT * FROM businesses";

if(!empty($search)){
    $sql .= " WHERE name LIKE '%$search%' 
              OR address LIKE '%$search%'
              OR phone LIKE '%$search%'
              OR email LIKE '%$search%'
              ";
}

$totalQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM businesses");
$totalData = mysqli_fetch_assoc($totalQuery)['total'];

$totalFiltered = mysqli_num_rows(mysqli_query($conn, $sql));

$sql .= " LIMIT $start, $limit";

$query = mysqli_query($conn, $sql);

$data = [];

while($row = mysqli_fetch_assoc($query)){

    $ratingQuery = mysqli_query($conn, "
        SELECT AVG(rating) as rating 
        FROM ratings WHERE business_id = ".$row['id']
    );

    $ratingRow = mysqli_fetch_assoc($ratingQuery);
    $rating = round($ratingRow['rating'],1);
    $start = $rating ? $rating : 'No rating';
    // data-bs-toggle="modal" data-bs-target="#BusinessRatingModal"

    $data[] = [
        $row['id'],
        $row['name'],
        $row['address'],
        $row['phone'],
        $row['email'],
        '<div class="rating" data-score="'.$start.'" data-id="'.$row['id'].'"></div>',
        '<td>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#SaveBusinessModal">Add</button>
            <button class="btn btn-sm btn-info editListing" data-id="'.$row['id'].'">Edit</button>
            <button class="btn btn-sm btn-danger deleteListing" data-id="'.$row['id'].'">Delete</button>
        </td>'
    ];
}

$json_data = [
    "draw" => intval($_POST['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
];

echo json_encode($json_data);
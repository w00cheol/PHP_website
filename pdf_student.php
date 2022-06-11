<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '111111',
    'mamp'
);
$table_html = '
    <table border="1">
        <tr>
        <th>    id  </th>
        <th>    name    </th>
        <th>    profile </th>
        </tr>
';
$sql = 'select * from student';
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
    $filtered = array(
        'id'=>htmlspecialchars($row['id']),
        'name'=>htmlspecialchars($row['name']),
        'profile'=>htmlspecialchars($row['profile']),
    );
    $table_html .= "
        <tr>
            <td>    {$filtered['id']}   </td>
            <td>    {$filtered['name']} </td>
            <td>    {$filtered['profile']}  </td>
        </tr>
    ";
}
$table_html .= '</table>';
?>

<?php
// Include the main TCPDF library (search for installation path).
require_once(realpath('../tcpdf/tcpdf.php'));
ob_end_clean();
// Set some content to print
$title = 'Hello ALS!';
$html = "<h1>".$title."</h1>";
// $html .= "<p style='color:#CC0000;'>End of document</p>";
$html .= $table_html;
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// Set font
//$pdf->SetFont('nanumgothic', '', 14, '', true);
// $pdf->SetFont('dejavusans');
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// Add a page
$pdf->AddPage();
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// Close and output PDF document
$pdf->Output('info_student.pdf', 'I'); // 화면으로 보여줌
// $pdf->Output(getcwd().'info_student.pdf', 'F'); // 실제 파일 생성됨
?> 
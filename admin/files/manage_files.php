<?php
$data = Files::get_list();
$files = $data['result'];
$total_rows = $data['total_rows'];

?>
<td colspan="2">
    files
</td>
<hr>
<table class="table table-bordered">
    <tr>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Godine</th>
        <th>Opcije</th>
    </tr>
    <? foreach($students as $student) : ?>
        <tr>
            <td><?=$student['ucenik_ime'] ?></td>
            <td><?=$student['ucenik_prezime'] ?></td>
            <td><?=$student['ucenik_godine'] ?></td>
            <td><a href="http://jpdesign.ba/sime_test/ucenici_janko/details.php?id=<?=$student['ucenik_id']?>"><img src="assets/img/details.png"></a>&nbsp<a href="" class="btn-edit-student" data-id="<?=$student['ucenik_id'] ?>" data-name="<?=$student['ucenik_ime'] ?>" data-surname="<?=$student['ucenik_prezime'] ?>" data-years="<?=$student['ucenik_godine'] ?>" data-school="<?=$student['skola_id'] ?>"><img src="assets/img/edit.png"></a>&nbsp<a href="" class="btn-delete-student" data-id="<?=$student['ucenik_id'] ?>"><img src="assets/img/delete.png"></a></td>
        </tr>
    <? endforeach; ?>
</table>
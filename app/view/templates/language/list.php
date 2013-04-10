<h2>Language List</h2>

<table border=1 >
<?php if(is_array($page['languages']) && sizeof($page['languages']) > 0) { ?>
<tr>
	<th>Id</th>
	<th>Name</th>
	<th>Download Links</th>
</tr>


<?php foreach($page['languages'] as $language) { ?>

<tr>
	<td><?php echo $language['id'] ?></td>
	<td><?php echo $language['language_name'] ?></td>
	<td><?php echo $language['download_link'] ?></td>
</tr>


<?php } ?>

<?php } ?>
</table>
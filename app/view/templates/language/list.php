<h2>Language List</h2>

<a href="/language/add">Add</a>

<table border=1 >
<?php if(is_array($this->page['languages']) && sizeof($this->page['languages']) > 0) { ?>
<tr>
	<th>Id</th>
	<th>Name</th>
	<th>Download Links</th>
	<th></th>
</tr>


<?php foreach($this->page['languages'] as $language) { ?>

<tr>
	<td><?php echo $language['id'] ?></td>
	<td><?php echo $language['language_name'] ?></td>
	<td><?php echo $language['download_link'] ?></td>
	<td><a href="<?php echo $this->helper->link('language/edit', array('id' => $language['id'])) ?>" >Edit</a> | <a href="<?php echo $this->helper->link('language/delete', array('id' => $language['id'])) ?>" >Delete</a></td>
	
</tr>


<?php } ?>

<?php } ?>
</table>
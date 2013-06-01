<h2>Edit Language</h2>

<form name="edit-form" id="add-form" method="post">
<input type="hidden" name="id" id="id" value="<?php echo $this->page['language']['id'] ?>" />
<div class="form-row">
<label for="name" >Name </label>
<input type="text" name="language_name" id="language_name" value="<?php echo $this->page['language']['language_name'] ?>" />
</div>
<div class="clear-row"></div>

<div class="form-row">
<label for="name" >Download Link </label>
<input type="text" name="download_link" id="download_link" value="<?php echo $this->page['language']['download_link'] ?>" />
</div>
<div class="clear-row"></div>

<div class="form-row">
<label for="name" >Home Link </label>
<input type="text" name="home_link" id="home_link" value="<?php echo $this->page['language']['home_link'] ?>" />
</div>
<div class="clear-row"></div>

<div class="form-row">
<input type="submit" name="submit" id="submit" value="Save" />
</div>
<div class="clear-row"></div>

</form>

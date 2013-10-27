<?php

/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */
 
/**
* generate.php is minimal scaffolding tool to generate admin skeleton for a module. Their will be a controller, model, and 3 views add, edit, list will be generated.
* Command Syntax should be like 
*         php generate.php [module_name] [table_name] 
*/

$app_conf = parse_ini_file(__DIR__.'/../config/app.ini', true);
$db_info = $app_conf['DB'];
$db = new mysqli($db_info['host'], $db_info['username'], $db_info['password'], $db_info['database']);

if($argc != 3)
{
	throw new Exception ('Syntax : '.PHP_EOL.' php generate.php [module_name] [table_name] ');
}	

if(is_numeric($argv[1]))
{
	throw new Exception ('Syntax : '.PHP_EOL.' php generate.php [module_name] [table_name] '.PHP_EOL.' (Note : only Word start from alphabets for moduleName is allowed) ');
}	

$module_name = $argv[1];
$cmodule_name = str_replace(' ', '', ucwords(str_replace('_', ' ', $module_name)));
$module_link_key = lcfirst($cmodule_name);
$table_name = $argv[2];

$result = $db->query('SHOW COLUMNS FROM '.$table_name);

while($row = $result->fetch_assoc())
{
	$fields[] = $row;	
}	

/// Generate Controller

$controller_skleton = "<?php

// __CMODULE__ Module Controller File

namespace SimpleFw\App\Controller;

use SimpleFw\Core\Mvc\Controller;
use SimpleFw\Core\Http\Request;
use SimpleFw\App\Model\__CMODULE__Model;
use SimpleFw\Core\Tools\FlashMessage;

class __CMODULE__Controller extends Controller
{
	public function listAction()
	{
		\$__MODULE__ = new __CMODULE__Model();
		\$__MODULE__s = \$__MODULE__->findAll();
		
		return array('__MODULE__s' => \$__MODULE__s);
	}
	
	public function addAction()
	{
		if(Request::getInstance()->hasPost())
		{
			\$post_data = Request::getInstance()->getPost();
			unset(\$post_data['submit']);
			\$__MODULE__ = new __CMODULE__Model();
			\$__MODULE__->insert(\$post_data);
			FlashMessage::getInstance()->setMessage('success', '__CMODULE__ Added');
			\$this->redirect('__MODULE_LINK__/list');
		}		
	}	
	
	public function editAction()
	{
		\$__MODULE__ = new __CMODULE__Model();
		\$__MODULE___row = \$__MODULE__->findRow((int)\$_GET['id']);
		if(empty(\$__MODULE___row))
		{
			throw new RouteException(104);
		}
		if(Request::getInstance()->hasPost())
		{
			\$post_data = Request::getInstance()->getPost();
			unset(\$post_data['submit']);
			\$__MODULE__ = new __CMODULE__Model();
			\$__MODULE__->update(\$post_data, array('id' => \$post_data['id'] ));
			FlashMessage::getInstance()->setMessage('success', '__CMODULE__ Updated');
			\$this->redirect('__MODULE_LINK__/list');
		}
		
		return array('__MODULE__' => \$__MODULE___row);				
	}	
	
	public function deleteAction()
	{
		\$__MODULE__ = new __CMODULE__Model();
		\$__MODULE___row = \$__MODULE__->findRow((int)\$_GET['id']);
		if(empty(\$__MODULE___row))
		{
			throw new RouteException(104);
		}
		\$__MODULE__->delete(array('id' => (int)\$_GET['id'] ));
		FlashMessage::getInstance()->setMessage('success', '__CMODULE__ Deleted');
		\$this->redirect('__MODULE_LINK__/list');
	}	
}	

?>
";

$controller_code = str_replace('__MODULE__', $module_name, $controller_skleton);
$controller_code = str_replace('__CMODULE__', $cmodule_name, $controller_code);
$controller_code = str_replace('__MODULE_LINK__', $module_link_key, $controller_code);

$file_path = __DIR__.'/../app/controller/'.$cmodule_name.'Controller.php';
touch($file_path);
file_put_contents($file_path, $controller_code);


/// Generate Model

$model_skleton = "<?php

// __CMODULE__ Module Model File

namespace SimpleFw\App\Model;

use SimpleFw\Core\Mvc\Model as Model;

class __CMODULE__Model extends Model
{
	public function findAll()
	{
		\$result = \$this->db->getQuery()->query('select * from __TABLE__ ')->execute();
		return \$result->fetchAll();
	}
	
	public function findRow(\$id)
	{
		\$result = \$this->db->getQuery()->query('select * from __TABLE__ where id =  '.\$id)->execute();
		return \$result->fetchRow();
	}
	
	public function insert(\$data)
	{
		\$this->db->getQuery()->insert('__TABLE__', \$data)->execute();
		return \$this->db->getQuery()->lastInsertId();
	}	
	
	public function update(\$data, \$filters)
	{
		\$this->db->getQuery()->update('__TABLE__', \$data, \$filters)->execute();
		return true;
	}

	public function delete(\$filters)
	{
		\$this->db->getQuery()->delete('__TABLE__', \$filters)->execute();
		return true;
	}

}	

?>";

$model_code = str_replace('__MODULE__', $module_name, $model_skleton);
$model_code = str_replace('__CMODULE__', $cmodule_name, $model_code);
$model_code = str_replace('__TABLE__', $table_name, $model_code);

$file_path = __DIR__.'/../app/model/'.$cmodule_name.'Model.php';
touch($file_path);
file_put_contents($file_path, $model_code);


// Add View

$view_dir_path = __DIR__.'/../app/view/templates/'.$module_link_key;

mkdir($view_dir_path, 0755);

$excluded_fields = array('id', 'date_added', 'date_modified', 'user_added', 'user_modified');

$view_skleton = '<h2>Add __CMODULE__</h2>
<form name="add-form" id="add-form" method="post">';

foreach($fields as $field_row) 
{
	if(!in_array($field_row['Field'], $excluded_fields))
	{
		$field_label = ucwords(str_replace('_', ' ', $field_row['Field']));
		$view_skleton .= '
			<div class="form-row">
			<label for="'.$field_row['Field'].'" >'.$field_label.'</label>
			<input type="text" name="'.$field_row['Field'].'" id="'.$field_row['Field'].'" />
			</div>
			<div class="clear-row"></div>';
	}		
}

$view_skleton .= '<div class="form-row">
<input type="submit" name="submit" id="submit" value="Save" />
</div>
<div class="clear-row"></div>
</form>';

$view_code = str_replace('__MODULE__', $module_name, $view_skleton);
$view_code = str_replace('__CMODULE__', $cmodule_name, $view_code);
$view_code = str_replace('__MODULE_LINK__', $module_link_key, $view_code);

$view_code = str_replace('__LOOP_START__', $module_link_key, $view_code);

$file_path = __DIR__.'/../app/view/templates/'.$module_link_key.'/add.php';
touch($file_path);
file_put_contents($file_path, $view_code);

 //Edit View

$view_skleton = '<h2>Edit __CMODULE__</h2>
<form name="edit-form" id="edit-form" method="post">';
$view_skleton .= '<input type="hidden" name="id" id="id" value="<?php echo $this->page[\'__MODULE__\'][\'id\'] ?>" />';

foreach($fields as $field_row) 
{
	if(!in_array($field_row['Field'], $excluded_fields))
	{
		$field_label = ucwords(str_replace('_', ' ', $field_row['Field']));
		$view_skleton .= '
			<div class="form-row">
			<label for="'.$field_row['Field'].'" >'.$field_label.'</label>
			<input type="text" name="'.$field_row['Field'].'" id="'.$field_row['Field'].'" value="<?php echo $this->page[\'__MODULE__\'][\''.$field_row['Field'].'\'] ?>" />
			</div>
			<div class="clear-row"></div>';
	}		
}

$view_skleton .= '<div class="form-row">
<input type="submit" name="submit" id="submit" value="Save" />
</div>
<div class="clear-row"></div>
</form>';

$view_code = str_replace('__MODULE__', $module_name, $view_skleton);
$view_code = str_replace('__CMODULE__', $cmodule_name, $view_code);
$view_code = str_replace('__MODULE_LINK__', $module_link_key, $view_code);

$file_path = __DIR__.'/../app/view/templates/'.$module_link_key.'/edit.php';
touch($file_path);
file_put_contents($file_path, $view_code);


// List View

$view_skleton = '<h2>__CMODULE__ Listing</h2>

<a href="/__MODULE_LINK__/add">Add</a>

<table class="grid" >
<thead>
<tr>';

foreach($fields as $field_row) 
{
	if(!in_array($field_row['Field'], $excluded_fields))
	{
		$field_label = ucwords(str_replace('_', ' ', $field_row['Field']));
		$view_skleton .= '<th>'.$field_label.'</th>';
	}		
}


$view_skleton .= '<th>&nbsp;</th>';

	
$view_skleton .= '</tr>
</thead>

<tbody>

	<?php if(is_array($this->page[\'__MODULE__s\']) && sizeof($this->page[\'__MODULE__s\']) > 0) { ?>

<?php foreach($this->page[\'__MODULE__s\'] as $__MODULE__) { ?>

<tr>';
	
	foreach($fields as $field_row) 
	{
		if(!in_array($field_row['Field'], $excluded_fields))
		{
			$view_skleton .= '<td><?php echo $__MODULE__[\''.$field_row['Field'].'\'] ?></td>';
		}
	}
	$view_skleton .= '<td><a href="<?php echo $this->helper->link(\'__MODULE_LINK__/edit\', array(\'id\' => $__MODULE__[\'id\'])) ?>" >Edit</a> | <a href="<?php echo $this->helper->link(\'__MODULE_LINK__/delete\', array(\'id\' => $__MODULE__[\'id\'])) ?>" >Delete</a></td>';
	
$view_skleton .= '</tr>

<?php } ?>
<?php } ?>
</tbody>
</table>';

$view_code = str_replace('__MODULE__', $module_name, $view_skleton);
$view_code = str_replace('__CMODULE__', $cmodule_name, $view_code);
$view_code = str_replace('__MODULE_LINK__', $module_link_key, $view_code);

$file_path = __DIR__.'/../app/view/templates/'.$module_link_key.'/list.php';
touch($file_path);
file_put_contents($file_path, $view_code);

?>
<?php
include 'backend/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Data</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="ajax/ajax.js"></script>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Додати нового користувача</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Видалити</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th scope="col" class="border-0 text-uppercase font-medium ">Name</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Status</th>
                        <th scope="col" class="border-0 text-uppercase font-medium text-center">Role</th>
                        <th scope="col" class="border-0 text-uppercase font-medium text-center">Options</th>
                    </tr>
                </thead>
				<tbody>
				<?php  
                $sql = $pdo->prepare("SELECT * FROM `users`");
                $sql->execute();
                $result = $sql->fetchAll();
                
                $sqll = $pdo->prepare("SELECT * FROM `roles`");
                $sqll->execute();
                $results = $sqll->fetchAll();
                ?> 
				<?php foreach ($result as $row): ?>
				<tr id="<?=$row["id"]; ?>">
				<td>
					<span class="custom-checkbox">
					    <input type="checkbox" class="user_checkbox" data-user-id="<?= $row["id"]; ?>">
					    <label for="checkbox2"></label>
					</span>
				</td>
                <td >
                   <h5 class="font-medium mb-0"><?=$row['first_name']?></h5>
                   <span class="text-muted"><?=$row['last_name']?></span>
               </td>
               <td class="text-center">
                   <span class="text-muted"><?=$row['status'] ? "<div  style='border-radius: 50%; width: 20px; height: 20px; background-color: green'></div>" : "<div style='border-radius: 50%; width: 20px; height: 20px; background-color: gray'></div>" ?></span>
               </td>
               <td class="text-center">
                   <span class="text-muted"><?=$row['role_id']?></span>
               </td>
               <td class="text-center">
                   <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                       <i class="material-icons update" data-toggle="tooltip"
                          data-id="<?=$row["id"] ?>"
                          data-first_name="<?= $row["first_name"] ?>"
                          data-last_name="<?=$row["last_name"] ?>"
                          data-status="<?=$row["status"] ?>"
                          data-role_id="<?=$row["role_id"] ?>"
                          title="Edit"></i>
                   </a>
                   <a href="#deleteEmployeeModal" class="delete" data-id="<?=$row["id"] ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
               </td>
           </tr>
                <?php endforeach ?>
				</tbody>
			</table>
            <div class="table-title">
                <div class="row">
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Додати нового користувача</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Видалити</span></a>						
					</div>
                </div>
            </div>	
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
                    <div class="form-group">
                   <label>First name</label>
                   <input type="text" id="first_name" name="first_name" class="form-control" required>
               </div>
               <div class="form-group">
                   <label>Last name</label>
                   <input type="text" id="last_name" name="last_name" class="form-control" required>
               </div>
               <div class="form-group">
                   <label class="checkbox-ios">Status  
                       <input type="hidden"  name="status"  value="0" >
                       <input type="checkbox" id="status" name="status"  value="1">
                       <span class="checkbox-ios-switch"></span>
                       </label>
               </div>
               <div class="form-group">
                   <select class="form-control category-select" id="role_id" name="role_id" type="text" required>
                       <option value="0">-виберіть роль-</option>
                       <?php foreach ($results as $item):?>
                           <option value="<?=$item['title'] ?>"><?=$item['title'] ?></option>
                       <?php endforeach ?>
                   </select>
               </div>					
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Вийти">
						<button type="button" class="btn btn-success" id="btn-add">Додати користувача</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>First name</label>
							<input type="text" id="first_name_u" name="first_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Last name</label>
							<input type="text" id="last_name_u" name="last_name" class="form-control" required>
						</div>
						<div class="form-group">
                        <label class="checkbox-ios">Status
                      <input type="hidden" value="0" name="status" >
                      <input type="checkbox" value="1" name="status" id='status_u' <?=$row['status'] ? "checked" : "" ?> >
                      <span class="checkbox-ios-switch"></span>
                        </label>
						</div>
						<div class="form-group">
                        <select class="form-control category-select" id="role_id_u" name="role_id">
                          <?php foreach ($results as $item){?>
                          <option <?=$item['title'] == $row['role_id'] ? "selected" : "" ?> value="<?=$item['title'] ?>"><?=$item['title'] ?></option>
                      <?php } ?>
                        </select>
                    </div>					
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Вихід">
						<button type="button" class="btn btn-info" id="update">Обновити</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Видалити користувача</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Ви впевнені що хочете видалити користувача?</p>
						<p class="text-warning"><small>Дану операцію неможливо скасувати</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Вихід">
						<button type="button" class="btn btn-danger" id="delete">Видалити</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>    
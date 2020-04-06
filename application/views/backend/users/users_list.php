<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="card-title">
              <a href="<?= site_url('backoffice/'.$controllers.'/add') ?>" ><button type="button" class="btn btn-block btn-primary"><i class="fas fa-plus-square"></i> <?= $title_menu; ?></button></a>
            </h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('backoffice/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><?= $title_header; ?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header"><h3 class="card-title"><?= $title_header; ?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="example" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Level</th>
                <th width="30">Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach($users as $data) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['usr_fullname'] ?></td>
                    <td><?= $data['usr_email'] ?></td>
                    <td>
                      <?php foreach ($levels as $level) : ?>
                      <?php if ($level['lvl_id'] == $data['usr_lvl_id']) : ?>
                        <?= $level['lvl_name']; ?>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?= $data['usr_slug'] ?>"><i class="fas fa-eye"></i></a>
                        <a href="<?= site_url('/backoffice/users/edit/'.$data['usr_slug']) ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <a href="<?= site_url('/backoffice/users/delete/'.encrypt_url($data['usr_id'])) ?>" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <?php $no=1; foreach($users as $data) : ?>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?= $data['usr_slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <ul class="list-group list-group-unbordered mb-3">
                        <div class="card-body box-profile">
                        <?php if ( $data['usr_photo'] == 'nophoto.png' ) : ?>
                          <div class="text-center">
                            <img class="profile-user-img img-fluid img-responsive"
                                 src="<?=base_url()?>assets/img/accounts/users/nophoto/nophoto.png"
                                 alt="User profile picture">
                          </div>
                        <?php else : ?>
                          <div class="text-center">
                            <img class="profile-user-img img-fluid img-responsive"
                                 src="<?= base_url()?>assets/img/accounts/users/<?= $data['usr_photo']; ?>"
                                 alt="User profile picture">
                          </div>
                        <?php endif; ?>
                        </div>
                        <li class="list-group-item">
                          Full Name : <?= $data['usr_fullname']; ?>
                        </li>
                        <li class="list-group-item">
                          Username : <?= $data['usr_email']; ?>
                        </li>
                        <li class="list-group-item">
                          Phone : <?= $data['usr_phone']; ?>
                        </li>
                        <li class="list-group-item">
                          Address : <?= $data['usr_address']; ?>
                        </li>                        
                        <li class="list-group-item">
                          Created At    : <?= $data['usr_created_at']; ?>
                        </li>
                        <?php foreach ($usersinfo as $userinfo) : ?>
                          <?php if ($userinfo['usr_id'] == $data['usr_created_by']) : ?>
                            <li class="list-group-item border-danger">
                              Created By  : <?= $userinfo['usr_fullname']; ?>
                            </li>
                          <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if($data['usr_edited_at'] != '0000-00-00 00:00:00') : ?>
                          <li class="list-group-item border-danger">
                            Edited At : <?= $data['usr_edited_at']; ?>
                          </li>
                        <?php endif ?>
                        <li class="list-group-item border-danger">
                          <?php foreach ($usersinfo as $userinfo) : ?>
                          <?php if ($userinfo['usr_id'] == $data['usr_edited_by']) : ?>
                            Edited By   : <?= $userinfo['usr_fullname']; ?>
                          <?php endif; ?>
                          <?php endforeach; ?>
                        </li>
                      </ul>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
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
                <th width="10">No</th>
                <th>Name</th>
                <th>Title Message</th>
                <th width="30">Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach($message as $data) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['msg_name'] ?></td>
                    <td><?= $data['msg_title'] ?></td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?= $data['msg_id'] ?>"><i class="fas fa-eye"></i></a>

                        <!-- only admin -->
                        <?php if($this->fungsi->user_login()->usr_lvl_id == '1') : ?>
                        <a href="<?= site_url('backoffice/'.$controllers.'/delete/'.encrypt_url($data['msg_id'])) ?>" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        <?php endif ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <?php foreach($message as $data) : ?>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?= $data['msg_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <li class="list-group-item">
                          Name : <?= $data['msg_name']; ?>
                        </li>
                        <li class="list-group-item">
                          Email : <?= $data['msg_email']; ?>
                        </li>
                        <li class="list-group-item">
                          Title Message : <?= $data['msg_title']; ?>
                        </li>
                        <li class="list-group-item">
                          Text Message : <?= $data['msg_text']; ?>
                        </li>
                        <!-- only admin -->
                        <?php if($this->fungsi->user_login()->usr_lvl_id == '1') : ?>
                          <li class="list-group-item">
                            Created At    : <?= $data['msg_created_at']; ?>
                          </li>
                        <?php endif ?>
                      </ul>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
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
<!-- /.content-wrapper
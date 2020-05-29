<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="card-title">
            <a href="<?= site_url('backoffice/'.$controllers.'/add') ?>" ><button type="button" class="btn btn-block btn-primary"><i class="fas fa-plus-square"></i> <?= $title_menu ?></button></a>
          </h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
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
                <th width="10">No</th>
                <th>Question</th>
                <th width="30">Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach($faqs as $data) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= substr($data['faq_question'], 0, 150) ?> ..</td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?= $data['faq_id'] ?>"><i class="fas fa-eye"></i></a>
                        <a href="<?= site_url('backoffice/'.$controllers.'/edit/'.$data['faq_slug']) ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <a href="<?= site_url('backoffice/'.$controllers.'/delete/'.encrypt_url($data['faq_id'])) ?>" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <?php foreach($faqs as $data) : ?>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?= $data['faq_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          Question : <?= $data['faq_question']; ?>
                        </li>
                        <li class="list-group-item">
                          Answer : <?= $data['faq_answer']; ?>
                        </li>
                        <li class="list-group-item">
                          Tags : 
                          <?php $explodetags = explode(',', $data['faq_tags']) ?>
                          <?php foreach($explodetags as $tags) : ?>
                            <?= '<div class="btn-group btn-group-sm"><a class="btn btn-secondary" style="color:white">'.$tags.'</a></div>'; ?>
                          <?php endforeach ?>
                        </li>

                        <!-- only admin -->
                        <?php if($this->fungsi->user_login()->usr_lvl_id == '1') : ?>
                          <?php if($data['faq_edited_at'] != '0000-00-00 00:00:00') : ?>
                            <li class="list-group-item border-danger">
                              Edited At : <?= $data['faq_edited_at']; ?>
                            </li>
                          <?php endif ?>
                          <?php foreach ($users as $user) : ?>
                          <?php if ($user['usr_id'] === $data['faq_edited_by']) : ?>
                            <li class="list-group-item border-danger">
                              Edited By   : <?= $user['usr_fullname']; ?>
                            </li>
                          <?php endif; ?>
                          <?php endforeach; ?>
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
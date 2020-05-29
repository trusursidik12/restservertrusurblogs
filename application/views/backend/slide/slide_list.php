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
          <div class="card-body">
            <div class="row mt-4">
              <?php foreach ($slides as $data) : ?>
                <div class="col-sm-3">
                  <div style="height: 180px; background-image : url(<?= base_url('assets/img/slide/'.$data['sld_image']); ?>);" class="position-relative p-3 bg_images_slide">
                    <div class="ribbon-wrapper ribbon-lg">
                      <div class="ribbon bg-secondary text-lg">
                        <div class="btn-group btn-group-sm">
                          <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?= $data['sld_slug']; ?>"><i class="fas fa-eye"></i></a>
                          <a href="<?= site_url('backoffice/slide/edit/'.$data['sld_slug']) ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                          <a href="<?= site_url('backoffice/slide/delete/'.encrypt_url($data['sld_id'])) ?>" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="text-dark">
                      <small><h3><?= $data['sld_name']; ?></h3></small>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>

              <?php foreach ($slides as $data) : ?>
                <!-- view details -->
                <div class="modal fade" id="exampleModal<?= $data['sld_slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="card-body box-profile">
                          <?php if ( $data['sld_image'] == 'noimageslide.png' ) : ?>
                            <div class="text-center">
                              <img class="img-fluid img-responsive" src="<?=base_url()?>assets/img/slide/noimageslide/noimageslide.png" alt="User profile picture">
                            </div>
                          <?php else : ?>
                            <div class="text-center">
                              <img class="img-fluid img-responsive" src="<?= base_url()?>assets/img/slide/<?= $data['sld_image']; ?>" alt="User profile picture">
                            </div>
                          <?php endif; ?>
                        </div>
                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                            Name           : <?= $data['sld_name']; ?>
                          </li>
                        <li class="list-group-item">
                          Tags : 
                          <?php $explodetags = explode(',', $data['sld_tags']) ?>
                          <?php foreach($explodetags as $tags) : ?>
                            <?= '<div class="btn-group btn-group-sm"><a class="btn btn-secondary" style="color:white">'.$tags.'</a></div>'; ?>
                          <?php endforeach ?>
                        </li>
                        <!-- admin only -->
                        <?php if ($this->fungsi->user_login()->usr_lvl_id == '1') : ?>
                          <li class="list-group-item">
                            Created At    : <?= $data['sld_created_at']; ?>
                          </li>
                          <li class="list-group-item border-danger">
                            <?php foreach ($users as $user) : ?>
                            <?php if ($user['usr_id'] === $data['sld_created_by']) : ?>
                              Created By  : <?= $user['usr_fullname']; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                          </li>
                          <?php if($data['sld_edited_at'] != '0000-00-00 00:00:00') : ?>
                            <li class="list-group-item border-danger">
                              Edited At     : <?= $data['sld_edited_at']; ?>
                            </li>
                          <?php endif ?>
                          <?php foreach ($users as $user) : ?>
                          <?php if ($user['usr_id'] === $data['sld_edited_by']) : ?>
                            <li class="list-group-item border-danger">
                              Edited At   : <?= $user['usr_fullname']; ?>
                            </li>
                          <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
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
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
                <th>Blog Title</th>
                <th width="100" class="text-center">Status</th>
                <th width="120" class="text-center">Images</th>
                <th width="30">Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach($blogs as $data) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= substr($data['blg_title'], 0, 30) ?> ..</td>
                    <td class="text-center">
                      <?php if($data['blg_status'] == '1')
                      { ?>
                        <div class="btn-group btn-group-sm"><a href="<?= site_url('backoffice/'.$controllers.'/edit/status/'.$data['blg_slug']) ?>" class='btn btn-primary'>Publish</a></div>
                      <?php } else
                      { ?>
                        <div class="btn-group btn-group-sm"><a href="<?= site_url('backoffice/'.$controllers.'/edit/status/'.$data['blg_slug']) ?>" class='btn btn-warning'>Draft</a></div>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <?php if ( $data['blg_image'] == 'noimageblogs.png' ) : ?>
                        <img src="<?=base_url('assets/img/'.$controllers.'/noimageblogs/noimageblogs.png')?>" width="100" height="100">
                      <?php else : ?>
                        <img src="<?= base_url('assets/img/'.$controllers.'/'.$data['blg_image'].'')?>" width="100" height="100"></td>
                      <?php endif ?>
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?= $data['blg_slug'] ?>"><i class="fas fa-eye"></i></a>
                        <a href="<?= site_url('backoffice/'.$controllers.'/edit/'.$data['blg_slug']) ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>

                        <!-- only admin -->
                        <?php if($this->fungsi->user_login()->usr_lvl_id == '1') : ?>
                        <a href="<?= site_url('backoffice/'.$controllers.'/delete/'.encrypt_url($data['blg_id'])) ?>" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        <?php endif ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <?php foreach($blogs as $data) : ?>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?= $data['blg_slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <?php if ( $data['blg_image'] == 'noimageblogs.png' ) : ?>
                          <div class="text-center">
                            <img class="img-fluid img-responsive"
                                 src="<?=base_url('assets/img/'.$controllers.'/noimageblogs/noimageblogs.png')?>"
                                 alt="User profile picture">
                          </div>
                        <?php else : ?>
                          <div class="text-center">
                            <img class="img-fluid img-responsive"
                                 src="<?= base_url('assets/img/'.$controllers.'/'.$data['blg_image'].'')?>"
                                 alt="User profile picture">
                          </div>
                        <?php endif; ?>
                        </div>
                        <li class="list-group-item">
                          Title Blog : <?= $data['blg_title']; ?>
                        </li>
                        <li class="list-group-item">
                          Text Content : <?= $data['blg_text_content']; ?>
                        </li>
                        <?php if(!empty($data['blg_video'])) : ?>
                          <li class="list-group-item">
                            <object width="100%" height="350" data="http://www.youtube.com/v/<?= substr($data['blg_video'], 32, 50); ?>" type="application/x-shockwave-flash"></object>
                          </li>
                        <?php endif ?>
                        <li class="list-group-item">
                          Tags : 
                          <?php $explodetags = explode(',', $data['blg_tags']) ?>
                          <?php foreach($explodetags as $tags) : ?>
                            <?= '<div class="btn-group btn-group-sm"><a class="btn btn-secondary" style="color:white">'.$tags.'</a></div>'; ?>
                          <?php endforeach ?>
                        </li>

                        <!-- only admin -->
                        <?php if($this->fungsi->user_login()->usr_lvl_id == '1') : ?>
                        <li class="list-group-item">
                          Created At    : <?= $data['blg_created_at']; ?>
                        </li>
                        <li class="list-group-item border-danger">
                          <?php foreach ($users as $user) : ?>
                          <?php if ($user['usr_id'] === $data['blg_created_by']) : ?>
                            Created By  : <?= $user['usr_fullname']; ?>
                          <?php endif; ?>
                          <?php endforeach; ?>
                        </li>
                        <?php if($data['blg_edited_at'] != '0000-00-00 00:00:00') : ?>
                          <li class="list-group-item border-danger">
                            Edited At : <?= $data['blg_edited_at']; ?>
                          </li>
                        <?php endif ?>
                        <?php foreach ($users as $user) : ?>
                        <?php if ($user['usr_id'] === $data['blg_edited_by']) : ?>
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
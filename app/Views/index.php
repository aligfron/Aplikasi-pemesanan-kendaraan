<?= $this->extend('tamplates/index'); ?>

<?= $this->section('content'); ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                    <?= csrf_field(); ?>
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="post" action="/Home/cekUser">
                                        <div class="form-group">
                                        <?php if (session()->getFlashdata('pesan')) : ?>
                                                <div class="alert alert-success" role="alert">
                                                    <?= session()->getFlashdata('pesan'); ?>
                                                </div>
                                            <?php endif ?>
                                            <?php
                                            if (session()->getFlashdata('errEmail')) {
                                                $isInvalEmail = 'is-invalid';
                                            } else {
                                                $isInvalEmail = '';
                                            }
                                            ?>
                                            <input type="email" class="<?= $isInvalEmail; ?> form-control form-control-user" name="email"
                                                id="exampleInputText" aria-describedby="emailHelp"
                                                placeholder="Enter Username...">
                                                <?php
                                            if (session()->getFlashdata('errEmail')) {
                                                echo '<div id="validationServer03Feedback" class="invalid-feedback">
                                            ' . session()->getFlashdata('errEmail') . '
                                            </div>';
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <?php
                                            $isInvalidpass = (session()->getFlashdata('errPassword')) ? 'is-invalid' : '';
                                            ?>
                                            <input type="password" name="pass" class="<?= $isInvalidpass; ?> form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                                <?php
                                            if (session()->getFlashdata('errPassword')) {
                                                echo '<div id="validationServer03Feedback" class="invalid-feedback">
                                            ' . session()->getFlashdata('errPassword') . '
                                            </div>';
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                            </div>
                                        
                                        <button type="submit"  class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>

    </div>

    <?= $this->endSection(); ?>
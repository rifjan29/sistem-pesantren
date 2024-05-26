<?php $this->extend('template/app') ?>
<?= $this->section('content') ?>

<div class="p-4 mt-14">
    <section class="p-5 overflow-y-auto">
        <div class="head lg:flex grid grid-cols-1 justify-between w-full">
            <div class="heading flex-auto">
                <p class="text-blue-950 font-sm text-xs">
                    Master Data
                </p>
                <h2 class="font-bold tracking-tighter text-2xl text-theme-text">
                    Data Santri
                </h2>
            </div>
            <div class="layout lg:flex grid grid-cols-1 lg:mt-0 mt-5 justify-end gap-5">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="<?= base_url('dashboard') ?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="<?= base_url('dashboard/santri') ?>" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Data Santri</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Ubah data</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
            <form action="<?= base_url('dashboard/santri/update/' . $data->id) ?>" method="POST" class="w-full mx-auto space-y-4" enctype="multipart/form-data">
                <div class="grid grid-cols-4 gap-3">
                    <div class="col-span-2">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nis<span class="me-2 text-red-500">*</span></label>
                        <input type="text" value="<?= set_value("nama", $data->nis) ?>" placeholder="Masukkan Nis" name="nis" id="nis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" maxlength="10">
                        <div class="text-red-500 text-xs italic font-semibold">
                            <?php if (session("validation.nis")) : ?>
                                <div class="text-red-500 text-sm">
                                    <?= session("validation.nis") ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama<span class="me-2 text-red-500">*</span></label>
                        <input type="text" value="<?= set_value("nama", $data->nama) ?>" placeholder="Masukkan Nama" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <div class="text-red-500 text-xs italic font-semibold">
                            <?php if (session("validation.nis")) : ?>
                                <div class="text-red-500 text-sm">
                                    <?= session("validation.nis") ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="telepon" class="block mb-2 text-sm font-semibold text-gray-900">Telepon<span class="me-2 text-red-500">*</span></label>
                        <input type="text" value="<?= set_value("nama", $data->telepon) ?>" placeholder="Masukkan Telepon" name="telepon" id="telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <div class="text-red-500 text-xs italic font-semibold">
                            <?php if (session("validation.telepon")) : ?>
                                <div class="text-red-500 text-sm">
                                    <?= session("validation.telepon") ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="gender" class="block mb-2 text-sm font-semibold text-gray-900">Jenis Kelamin<span class="me-2 text-red-500">*</span></label>
                        <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value=""> == Pilih Gender == </option>
                            <option <?= $data->gender == 'l' ? 'selected' : '' ?> value="l">Laki Laki</option>
                            <option <?= $data->gender == 'p' ? 'selected' : '' ?> value="p">Perempuan</option>
                        </select>
                        <div class="text-red-500 text-xs italic font-semibold">
                            <?php if (session("validation.gender")) : ?>
                                <div class="text-red-500 text-sm">
                                    <?= session("validation.gender") ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="tanggal_lahir" class="block mb-2 text-sm font-semibold text-gray-900">Tanggal Lahir<span class="me-2 text-red-500">*</span></label>
                        <input value="<?= set_value("tanggal_lahir", $data->tanggal_lahir) ?>" type="date" name="tanggal_lahir" id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <div class="text-red-500 text-xs italic font-semibold">
                            <?php if (session("validation.tanggal_lahir")) : ?>
                                <div class="text-red-500 text-sm">
                                    <?= session("validation.tanggal_lahir") ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="tanggal_masuk" class="block mb-2 text-sm font-semibold text-gray-900">Tanggal Masuk<span class="me-2 text-red-500">*</span></label>
                        <input type="date" value="<?= set_value("tanggal_masuk", $data->tanggal_masuk) ?>" name="tanggal_masuk" id="tanggal_masuk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <div class="text-red-500 text-xs italic font-semibold">
                            <?php if (session("validation.tanggal_masuk")) : ?>
                                <div class="text-red-500 text-sm">
                                    <?= session("validation.tanggal_masuk") ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="alamat" class="block mb-2 text-sm font-semibold text-gray-900">Alamat<span class="me-2 text-red-500">*</span></label>
                        <textarea name="alamat" id="alamat" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"><?= set_value("alamat", $data->alamat) ?></textarea>
                        <div class="text-red-500 text-xs italic font-semibold">
                            <?php if (session("validation.alamat")) : ?>
                                <div class="text-red-500 text-sm">
                                    <?= session("validation.alamat") ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end align-middle content-center bg-gray-100 p-3 rounded-md">
                    <div>
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Simpan</button>
                    </div>
                    <div>
                        <a href="<?= base_url('dashboard/santri') ?>" class="bg-white text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" type="reset">Batal</a>
                    </div>

                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endsection() ?>
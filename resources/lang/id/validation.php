<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    // :attribute, :date, :min, :max, :format, :other, :digits, :value, :values, :size
    'accepted'             => 'Kolom :attribute Harus Disetujui !',
    'active_url'           => 'Kolom :attribute Harus URL Yang Valid !',
    'after'                => 'Kolom :attribute Harus Sesudah Tanggal :date !',
    'after_or_equal'       => 'Kolom :attribute Harus Sesudah/Sama Dengan Tanggal :date !',
    'alpha'                => 'Kolom :attribute Harus Berupa Huruf !',
    'alpha_dash'           => 'Kolom :attribute Harus Berupa Huruf, Angka, "-" Dan "_" !',
    'alpha_num'            => 'Kolom :attribute Harus Berupa Huruf Atau Angka !',
    'array'                => 'Kolom :attribute Harus Berupa Array !',
    'before'               => 'Kolom :attribute Harus Sebelum Tanggal :date !',
    'before_or_equal'      => 'Kolom :attribute Harus Sebelum/Sama Dengan Tanggal :date !',
    'between'              => [
        'numeric' => 'Kolom :attribute Valid Antara :min-:max !',
        'file'    => 'Kolom :attribute Valid Antara :min-:max Kilobytes !',
        'string'  => 'Kolom :attribute Valid Antara :min-:max Karakter !',
        'array'   => 'Kolom :attribute Valid Antara :min-:max Item !',
    ],
    'boolean'              => 'Kolom :attribute Harus Berupa Benar Atau Salah !',
    'confirmed'            => 'Kolom :attribute Tidak Cocok Dengan Konfirmasi !',
    'date'                 => 'Kolom :attribute Tidak Valid !',
    'date_format'          => 'Kolom :attribute Tidak Cocok Dengan Format :format !',
    'different'            => 'Kolom :attribute Dan Kolom :other Harus Berbeda !',
    'digits'               => 'Kolom :attribute Harus :digits Digit !',
    'digits_between'       => 'Kolom :attribute Valid Antara :min-:max Digit !',
    'dimensions'           => 'Kolom :attribute Memiliki Dimensi Yang Tidak Valid !',
    'distinct'             => 'Kolom :attribute Memiliki Duplikat !',
    'email'                => 'Kolom :attribute Tidak Valid !',
    'exists'               => 'Kolom :attribute Tidak Valid !',
    'file'                 => 'Kolom :attribute Harus Berupa File !',
    'filled'               => 'Kolom :attribute Harus Memiliki Isi !',
    'image'                => 'Kolom :attribute Harus Berupa Gambar !',
    'in'                   => 'Kolom :attribute Tidak Valid !',
    'in_array'             => 'Kolom :attribute Tidak Cocok Dengan :other !',
    'integer'              => 'Kolom :attribute Harus Berupa Angka !',
    'ip'                   => 'Kolom :attribute Tidak Valid !',
    'ipv4'                 => 'Kolom :attribute Harus Berupa IPv4 !',
    'ipv6'                 => 'Kolom :attribute Harus Berupa IPv6 !',
    'json'                 => 'Kolom :attribute Harus Berupa JSON !',
    'max'                  => [
        'numeric' => 'Kolom :attribute Maksimal :max !',
        'file'    => 'Kolom :attribute Maksimal :max Kilobytes !',
        'string'  => 'Kolom :attribute Maksimal :max Karakter !',
        'array'   => 'Kolom :attribute Maksimal :max Item !',
    ],
    'mimes'                => 'Kolom :attribute Hanya Valid Tipe File : :values !',
    'mimetypes'            => 'Kolom :attribute Hanya Valid Tipe File : :values !',
    'min'                  => [
        'numeric' => 'Kolom :attribute Minimal :min !',
        'file'    => 'Kolom :attribute Minimal :min Kilobytes !',
        'string'  => 'Kolom :attribute Minimal :min Karakter !',
        'array'   => 'Kolom :attribute Minimal :min Item !',
    ],
    'not_in'               => 'Kolom :attribute Tidak Valid !',
    'numeric'              => 'Kolom :attribute Harus Berupa Angka !',
    'present'              => 'Kolom :attribute Harus Ada !',
    'regex'                => 'Kolom :attribute Tidak Valid !',
    'required'             => 'Kolom :attribute Tidak Boleh Kosong !',
    'required_if'          => 'Kolom :attribute Tidak Boleh Kosong Jika :other Adalah :value !',
    'required_unless'      => 'Kolom :attribute Tidak Boleh Kosong Kecuali :other Adalah :values !',
    'required_with'        => 'Kolom :attribute Tidak Boleh Kosong Jika :values Ada !',
    'required_with_all'    => 'Kolom :attribute Tidak Boleh Kosong Jika Ada :values !',
    'required_without'     => 'Kolom :attribute Tidak Boleh Kosong Jika :values Tidak Ada !',
    'required_without_all' => 'Kolom :attribute Tidak Boleh Kosong Jika Tidak Ada :values !',
    'same'                 => 'Kolom :attribute Harus Sama Dengan Kolom :other !',
    'size'                 => [
        'numeric' => 'Kolom :attribute Ukuran Maksimal :size !',
        'file'    => 'Kolom :attribute Ukuran Maksimal :size Kilobytes !',
        'string'  => 'Kolom :attribute Ukuran Maksimal :size Karakter !',
        'array'   => 'Kolom :attribute Ukuran Maksimal :size Item !',
    ],
    'string'               => 'Kolom :attribute Harus Berupa Huruf !',
    'timezone'             => 'Kolom :attribute Harus Dalam Zona Yang Valid !',
    'unique'               => 'Kolom :attribute Sudah Terdaftar !',
    'uploaded'             => 'Kolom :attribute Gagal Diunggah !',
    'url'                  => 'Kolom :attribute Tidak Valid !',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'alamat' => 'Alamat',

        'cabang' => 'Cabang',
        'confpassword' => 'Konfirmasi Password',
        'confnewpassword' => 'Konfirmasi Password Baru',

        'gaji_pokok' => 'Gaji Pokok',
        'golongan' => 'Golongan',
        'golongan_gaji' => 'Golongan Gaji',

        'jabatan' => 'Jabatan',
        'jenis_kelamin' => 'Jenis Kelamin',

        'name' => 'Name',
        'nik' => 'NIK',
        'no_telp' => 'No. Telepon',
        'newpassword' => 'Password Baru',

        'oldpassword' => 'Password Lama',

        'password' => 'Password',

        'status_perkawinan' => 'Status Perkawinan',

        'tanggal_lahir' => 'Tanggal Lahir',
        'tempat_lahir' => 'Tempat Lahir',
        'tempat_tinggal' => 'Tempat Tinggal',
        'tingkat' => 'Tingkat',

        'username' => 'Username',
    ],

];

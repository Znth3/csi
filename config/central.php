<?php

return [
    'default_paginate_item' => 50,

    'folder' => [
        'staff_photo' => 'public/photo/tendik',
        'lecturer_photo' => 'public/photo/lecturer',
        'student_photo' => 'public/photo/student',
        'ijazah' => 'public/ijazah',
        'thesis_logbook_file_progress' => 'public/logbook/thesis'
    ],

   'family_relationship' => [
       1 => 'Suami/Istri',
       2 => 'Ayah/Ibu',
       3 => 'Ayah/Ibu Mertua',
       4 => 'Anak Kandung',
       5 => 'Saudara Kandung',
       6 => 'Anak Angkat'
   ],

    'gender' => [
        1 => 'Pria',
        2 => 'Wanita',
    ],

    'marital_status' => [
        1 => 'Belum Menikah',
        2 => 'Menikah',
        3 => 'Janda/Duda'
    ],

    'religion' => [
        1 => 'Islam',
        2 => 'Kristen Protestan',
        3 => 'Kristen Katolik',
        4 => 'Hindu',
        5 => 'Budha'
    ],

    'lecturer_association' => [
        1 => 'Dosen Tetap PNS',
        2 => 'Dosen Tetap Non PNS',
        3 => 'Dosen Luar Biasa'
    ],

    'employee_association' => [
        1 => 'Karyawan Tetap PNS',
        2 => 'Karyawan Tetap Non PNS'
    ],

    'alive_status' => [
        0 => 'Meninggal',
        1 => 'Masih Hidup'
    ],

    'domestic' => [
        0 => 'Dalam Negri',
        1 => 'Luar Negri'
    ],

    'research_position' => [
        1 => 'Ketua',
        2 => 'Anggota'
    ],

    'education_level' => [
        1 => 'TK',
        2 => 'SD Sederajat',
        3 => 'SMP Sederajat',
        4 => 'SMA Sederajat',
        5 => 'D1',
        6 => 'D2',
        7 => 'D3',
        8 => 'D4',
        9 => 'S1',
        10 => 'S2',
        11 => 'S3'
    ],

    'attendance_student' => [
        0 => 'Absen',
        1 => 'Hadir',
        2 => 'Absen',
        3 => 'Izin',
        4 => 'Sakit'

    'thesis_supervisor_position' => [
        1 => 'Pembimbing Tunggal',
        2 => 'Pembimbing Utama',
        3 => 'Pembimbing Pendamping'
    ],

    'thesis_supervisor_status' => [
        0 => 'Submitted',
        1 => 'Accepted',
        2 => 'Rejected'
    ]
];

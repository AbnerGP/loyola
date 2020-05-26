<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            margin: 0px 0px 0px 0px !important;
            padding: 0px 0px 0px 0px !important;
        }
        .page-break {
            page-break-after: always;
        }
        div, img {
            display: block;
            position: absolute;
            width: 816px;
            height: 1344px;
        }
        div, p {
            font-weight: bold;
            position: absolute;
        }
        .form_date {
            {{ $r->p('date') }}
        }
        .inscription {
            {{ $r->p('inscription') }}
        }
        .reinscription {
            {{ $r->p('reinscription') }}
        }
        .form_name {
            {{ $r->p('name') }}
        }
        .form_last_name {
            {{ $r->p('last_name') }}
        }
        .form_mat_last_name {
            {{ $r->p('mat_last_name') }}
        }
        .form_curp {
            {{ $r->p('curp') }}
        }
        .form_grade {
            {{ $r->p('grade') }}
        }
        .form_sanguine {
            {{ $r->p('sanguine') }}
        }
        .form_place_birth {
            {{ $r->p('place_birth') }}
        }
        .form_birthday {
            {{ $r->p('birthday') }}
        }
        .form_age {
            {{ $r->p('age') }}
        }
        .form_street {
            {{ $r->p('street') }}
        }
        .form_number {
            {{ $r->p('number') }}
        }
        .form_colony {
            {{ $r->p('colony') }}
        }
        .form_town {
            {{ $r->p('town') }}
        }
        .form_zip_code {
            {{ $r->p('zip_code') }}
        }
        .form_origin_school {
            {{ $r->p('origin_school') }}
        }
        .form_f_name {
            {{ $r->p('f_name') }}
        }
        .form_f_company {
            {{ $r->p('f_company') }}
        }
        .form_f_position {
            {{ $r->p('f_position') }}
        }
        .form_f_office_phone {
            {{ $r->p('f_office_phone') }}
        }
        .form_f_home_phone {
            {{ $r->p('f_home_phone') }}
        }
        .form_f_cellphone {
            {{ $r->p('f_cellphone') }}
        }
        .form_f_email {
            {{ $r->p('f_email') }}
        }
        .form_m_name {
            {{ $r->p('m_name') }}
        }
        .form_m_company {
            {{ $r->p('m_company') }}
        }
        .form_m_position {
            {{ $r->p('m_position') }}
        }
        .form_m_office_phone {
            {{ $r->p('m_office_phone') }}
        }
        .form_m_home_phone {
            {{ $r->p('m_home_phone') }}
        }
        .form_m_cellphone {
            {{ $r->p('m_cellphone') }}
        }
        .form_m_email {
            {{ $r->p('m_email') }}
        }
        .form_o_name {
            {{ $r->p('o_name') }}
        }
        .form_relationship {
            {{ $r->p('relationship') }}
        }
        .form_o_office_phone {
            {{ $r->p('o_office_phone') }}
        }
        .form_o_home_phone {
            {{ $r->p('o_home_phone') }}
        }
        .form_o_cellphone {
            {{ $r->p('o_cellphone') }}
        }
        .form_o_email {
            {{ $r->p('o_email') }}
        }
        .form_observations {
            {{ $r->p('observations') }}
        }
        .auth {
            {{ $r->p('auth') }}
        }
        .no_auth {
            {{ $r->p('no_auth') }}
        }
        .full_name {
            {{ $r->p('full_name') }}
        }
        .back_grade {
            {{ $r->p('back_grade') }}
        }
        .day {
           {{ $r->p('day') }}
        }
        .month {
            {{ $r->p('month') }}
        }
        .year {
            {{ $r->p('year') }}
        }
    </style>
</head>
<body>
<div>
    <img src="{{ url('images/pdf/'.$r->level.'.jpg') }}">
    <p class="form_date">{{ $r->date }}</p>
    <p class="inscription" @if($r->type == 2) style="display: none;" @endif >X</p>
    <p class="reinscription" @if($r->type == 1) style="display: none;" @endif >X</p>
    <p class="form_name">{{ $r->name }}</p>
    <p class="form_last_name">{{ $r->last_name }}</p>
    <p class="form_mat_last_name">{{ $r->mat_last_name }}</p>
    <p class="form_curp">{{ $r->curp }}</p>
    <p class="form_grade">{{ $r->grade }}</p>
    <p class="form_sanguine">{{ $r->sanguine }}</p>
    <p class="form_place_birth">{{ $r->place_birth }}</p>
    <p class="form_birthday">{{ $r->birthday }}</p>
    <p class="form_age">{{ $r->age }}</p>
    <p class="form_street">{{ $r->street }}</p>
    <p class="form_number">{{ $r->number }}</p>
    <p class="form_colony">{{ $r->colony }}</p>
    <p class="form_town">{{ $r->town }}</p>
    <p class="form_zip_code">{{ $r->zip_code }}</p>
    <p class="form_origin_school">{{ $r->origin_school }}</p>
    <p class="form_f_name">{{ $r->f_name . ' ' . $r->f_last_name . ' ' . $r->f_mat_last_name}}</p>
    <p class="form_f_company">{{ $r->f_company }}</p>
    <p class="form_f_position">{{ $r->f_position }}</p>
    <p class="form_f_office_phone">{{ $r->f_office_phone }}</p>
    <p class="form_f_home_phone">{{ $r->f_home_phone }}</p>
    <p class="form_f_cellphone">{{ $r->f_cellphone }}</p>
    <p class="form_f_email">{{ $r->f_email }}</p>
    <p class="form_m_name">{{ $r->m_name . ' ' . $r->m_last_name . ' ' . $r->m_mat_last_name}}</p>
    <p class="form_m_company">{{ $r->m_company }}</p>
    <p class="form_m_position">{{ $r->m_position }}</p>
    <p class="form_m_office_phone">{{ $r->m_office_phone }}</p>
    <p class="form_m_home_phone">{{ $r->m_home_phone }}</p>
    <p class="form_m_cellphone">{{ $r->m_cellphone }}</p>
    <p class="form_m_email">{{ $r->m_email }}</p>
    <p class="form_o_name">{{ $r->o_name . ' ' . $r->o_last_name . ' ' . $r->o_mat_last_name}}</p>
    <p class="form_relationship">{{ $r->relationship }}</p>
    <p class="form_o_office_phone">{{ $r->o_office_phone }}</p>
    <p class="form_o_home_phone">{{ $r->o_home_phone }}</p>
    <p class="form_o_cellphone">{{ $r->o_cellphone }}</p>
    <p class="form_o_email">{{ $r->o_email }}</p>
    <p class="form_observations">{{ $r->observations }}</p>
    <p class="auth" @if($r->authorization == 2) style="display: none;" @endif >X</p>
    <p class="no_auth" @if($r->authorization == 1) style="display: none;" @endif >X</p>
</div>
<div class="page-break"></div>
<div>
    <img src="{{ url('images/pdf/back/'.$r->level.'.jpg') }}">
    <p class="full_name">{{ $r->name . ' ' . $r->last_name . ' ' . $r->mat_last_name }}</p>
    <p class="back_grade">{{ $r->grade }}</p>
    <p class="day">{{ date('d', strtotime($r->date)) }}</p>
    <p class="month">{{ spanish_month(date('n', strtotime($r->date))) }}</p>
    <p class="year">{{ date('Y', strtotime($r->date)) }}</p>
</div>
</body>
</html>

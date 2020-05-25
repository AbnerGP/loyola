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
            top: 111px;
            left: 650px;
        }
        .inscription {
            top: 268px;
            left: 395px;
        }
        .reinscription {
            top: 268px;
            left: 596px;
        }
        .form_name {
            top: 296px;
            left: 140px;
        }
        .form_last_name {
            top: 296px;
            left: 365px;
        }
        .form_mat_last_name {
            top: 296px;
            left: 580px;
        }
        .form_curp {
            top: 335px;
            left: 120px;
        }
        .form_grade {
            top: 335px;
            left: 440px;
        }
        .form_sanguine {
            top: 335px;
            left: 630px;
        }
        .form_place_birth {
            top: 377px;
            left: 198px;
        }
        .form_birthday {
            top: 377px;
            left: 505px;
        }
        .form_age {
            top: 377px;
            left: 677px;
        }
        .form_street {
            top: 417px;
            left: 140px;
        }
        .form_number {
            top: 417px;
            left: 380px;
        }
        .form_colony {
            top: 417px;
            left: 550px;
        }
        .form_town {
            top: 454px;
            left: 140px;
        }
        .form_zip_code {
            top: 454px;
            left: 320px;
        }
        .form_origin_school {
            top: 454px;
            left: 560px;
        }
        .form_f_name {
            top: 523px;
            left: 210px;
        }
        .form_f_company {
            top: 555px;
            left: 210px;
        }
        .form_f_position {
            top: 555px;
            left: 515px;
        }
        .form_f_office_phone {
            top: 585px;
            left: 140px;
        }
        .form_f_home_phone {
            top: 585px;
            left: 270px;
        }
        .form_f_cellphone {
            top: 585px;
            left: 400px;
        }
        .form_f_email {
            top: 585px;
            left: 510px;
        }
        .form_m_name {
            top: 626px;
            left: 210px;
        }
        .form_m_company {
            top: 656px;
            left: 210px;
        }
        .form_m_position {
            top: 656px;
            left: 515px;
        }
        .form_m_office_phone {
            top: 687px;
            left: 140px;
        }
        .form_m_home_phone {
            top: 687px;
            left: 270px;
        }
        .form_m_cellphone {
            top: 687px;
            left: 400px;
        }
        .form_m_email {
            top: 687px;
            left: 510px;
        }
        .form_o_name {
            top: 751px;
            left: 130px;
        }
        .form_relationship {
            top: 751px;
            left: 520px;
        }
        .form_o_office_phone {
            top: 782px;
            left: 140px;
        }
        .form_o_home_phone {
            top: 782px;
            left: 270px;
        }
        .form_o_cellphone {
            top: 782px;
            left: 400px;
        }
        .form_o_email {
            top: 782px;
            left: 510px;
        }
        .form_observations {
            top: 1013px;
            left: 72px;
            font-size: 12px;
            width: 590px;
            text-align: justify;
        }
        .auth {
            top: 1080px;
            left: 697px;
        }
        .no_auth {
            top: 1080px;
            left: 730px;
        }
    </style>
</head>
<body>
<div>
    <img src="{{ url('images/pdf/cendi.jpg') }}">
    <p class="form_date">{{ $request->date }}</p>
    <p class="inscription" @if($request->type == 2) style="display: none;" @endif >X</p>
    <p class="reinscription" @if($request->type == 1) style="display: none;" @endif >X</p>
    <p class="form_name">{{ $request->name }}</p>
    <p class="form_last_name">{{ $request->last_name }}</p>
    <p class="form_mat_last_name">{{ $request->mat_last_name }}</p>
    <p class="form_curp">{{ $request->curp }}</p>
    <p class="form_grade">{{ $request->grade }}</p>
    <p class="form_sanguine">{{ $request->sanguine }}</p>
    <p class="form_place_birth">{{ $request->place_birth }}</p>
    <p class="form_birthday">{{ $request->birthday }}</p>
    <p class="form_age">{{ $request->age }}</p>
    <p class="form_street">{{ $request->street }}</p>
    <p class="form_number">{{ $request->number }}</p>
    <p class="form_colony">{{ $request->colony }}</p>
    <p class="form_town">{{ $request->town }}</p>
    <p class="form_zip_code">{{ $request->zip_code }}</p>
    <p class="form_origin_school">{{ $request->origin_school }}</p>
    <p class="form_f_name">{{ $request->f_name . ' ' . $request->f_last_name . ' ' . $request->f_mat_last_name}}</p>
    <p class="form_f_company">{{ $request->f_company }}</p>
    <p class="form_f_position">{{ $request->f_position }}</p>
    <p class="form_f_office_phone">{{ $request->f_office_phone }}</p>
    <p class="form_f_home_phone">{{ $request->f_home_phone }}</p>
    <p class="form_f_cellphone">{{ $request->f_cellphone }}</p>
    <p class="form_f_email">{{ $request->f_email }}</p>
    <p class="form_m_name">{{ $request->m_name . ' ' . $request->m_last_name . ' ' . $request->m_mat_last_name}}</p>
    <p class="form_m_company">{{ $request->m_company }}</p>
    <p class="form_m_position">{{ $request->m_position }}</p>
    <p class="form_m_office_phone">{{ $request->m_office_phone }}</p>
    <p class="form_m_home_phone">{{ $request->m_home_phone }}</p>
    <p class="form_m_cellphone">{{ $request->m_cellphone }}</p>
    <p class="form_m_email">{{ $request->m_email }}</p>
    <p class="form_o_name">{{ $request->o_name . ' ' . $request->o_last_name . ' ' . $request->o_mat_last_name}}</p>
    <p class="form_relationship">{{ $request->relationship }}</p>
    <p class="form_o_office_phone">{{ $request->o_office_phone }}</p>
    <p class="form_o_home_phone">{{ $request->o_home_phone }}</p>
    <p class="form_o_cellphone">{{ $request->o_cellphone }}</p>
    <p class="form_o_email">{{ $request->o_email }}</p>
    <p class="form_observations">{{ $request->observations }}</p>
    <p class="auth" @if($request->authorization == 2) style="display: none;" @endif >X</p>
    <p class="no_auth" @if($request->authorization == 1) style="display: none;" @endif >X</p>
</div>
<div class="page-break"></div>
<div>
    <img src="{{ url('images/pdf/cendi.jpg') }}">
</div>
</body>
</html>

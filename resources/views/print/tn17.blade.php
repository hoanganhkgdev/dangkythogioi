<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đơn Xin Thọ Giới Tỳ Kheo - {{ $application->full_name }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 2cm 2.5cm;
        }
        @media print {
            .no-print { display: none !important; }
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 13pt;
            line-height: 14pt;
            color: #000;
        }


        /* ===== BẢNG HEADER ===== */
        .mau-code-top {
            text-align: right;
            font-size: 11pt;
            text-decoration: underline;
            margin-bottom: 4px;
        }
        .tbl {
            width: 100%;
            border-collapse: collapse;
        }
        .tbl td {
            border: none;
            padding: 4px 6px;
            vertical-align: top;
        }
        .tbl .col-left {
            text-align: center;
            font-size: 12pt;
            line-height: 17pt;
        }
        .col-left .ban-tri-su {
            font-size: 12pt;
            font-weight: bold;
            border-bottom: 1.5pt solid #000;
            display: inline-block;
            padding-bottom: 1px;
            margin-bottom: 2px;
        }
        .col-left .dai-gioi-dan {
            font-size: 12pt;
            font-weight: bold;
        }
        .col-left .dan-name {
            font-size: 12pt;
        }
        .col-left .pl-dl {
            font-size: 12pt;
            font-weight: bold;
        }
        .tbl .col-right {
            text-align: center;
            font-size: 11pt;
            line-height: 17pt;
        }
        .col-right .cong-hoa {
            font-size: 11pt;
            font-weight: bold;
            white-space: nowrap;
        }
        .col-right .doc-lap {
            font-size: 12pt;
            font-weight: bold;
            text-decoration: underline;
        }

        /* ===== SECTION: ẢNH + TIÊU ĐỀ + KÍNH GỬI ===== */
        .section-title-wrap {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }
        .section-title-wrap td {
            border: none;
            vertical-align: top;
            padding: 0;
        }
        .col-photo-left {
            width: 110px;
            padding-right: 10px !important;
        }
        .photo-box {
            width: 90px;
            height: 120px;
            border: 1pt solid #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 9pt;
            text-align: center;
            line-height: 1.4;
            overflow: hidden;
        }
        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .col-content-right {
            vertical-align: top;
        }

        /* ===== TIÊU ĐỀ ===== */
        .doc-title {
            text-align: center;
            font-size: 18pt;
            font-weight: bold;
            line-height: 22pt;
            margin-bottom: 8px;
        }

        /* ===== KÍNH GỬI ===== */
        .kinh-gui {
            margin: 0 0 4px 92px;
            text-indent: -51px;
            font-size: 12.5pt;
            line-height: 17pt;
        }
        .kinh-gui-tinh {
            margin: 4px 0 0 92px;
            font-size: 12.5pt;
            font-weight: bold;
            text-decoration: underline;
        }

        /* ===== TRƯỜNG THÔNG TIN ===== */
        .fields {
            margin-top: 4px;
        }
        .fr {
            display: flex;
            align-items: baseline;
            margin-bottom: 4px;
            font-size: 13pt;
            line-height: 16pt;
            gap: 2px;
        }
        .fl {
            white-space: nowrap;
            flex-shrink: 0;
        }
        .fl-i { font-size: 10pt; font-style: italic; }
        .fv {
            flex: 1;
            min-height: 16pt;
            padding: 0 4px 1px;
            font-weight: bold;
        }
        .fv-blank { font-weight: normal; }
        .extra-line {
            min-height: 16pt;
            margin-bottom: 4px;
            font-size: 13pt;
            font-weight: bold;
        }
        .fr-2col {
            display: flex;
            gap: 10px;
            margin-bottom: 4px;
        }
        .fr-2col .fr { flex: 1; margin-bottom: 0; }

        /* ===== NỘI DUNG VĂN BẢN ===== */
        .body-para {
            text-align: justify;
            font-size: 13pt;
            line-height: 14pt;
            margin-bottom: 6px;
        }

        /* ===== BẢNG THỦ TỤC + KÝ TÊN ===== */
        .tbl-bottom td {
            border: none;
            padding: 5px 6px;
            vertical-align: top;
        }
        .col-thutuc {
            font-size: 10pt;
            line-height: 13pt;
        }
        .col-thutuc ul {
            list-style: none;
            padding-left: 8px;
        }
        .col-thutuc ul li::before { content: "- "; }
        .col-thutuc .luu-y {
            font-size: 10pt;
            margin-top: 4px;
        }

        .col-kinhdon {
            text-align: center;
            font-size: 11pt;
            line-height: 14pt;
        }
        .col-kinhdon .date-line { margin-bottom: 2px; font-style: italic; white-space: nowrap; }
        .col-kinhdon .kd-title { font-weight: bold; font-size: 12pt; }
        .col-kinhdon .kd-instr { font-style: italic; font-size: 9pt; }
        .col-kinhdon .kd-blank { height: 65px; }
        .col-kinhdon .kd-name { font-size: 11pt; line-height: 14pt; }

        /* ===== XÁC NHẬN BỔN SƯ (bên dưới bảng, KHÔNG có khung) ===== */
        .xac-nhan-title {
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            line-height: 14pt;
            margin: 8px 0 0 0;
        }
        .xac-nhan-blank {
            height: 40px;
        }
        .xac-nhan-sign {
            width: 55%;
            margin-left: auto;
            text-align: center;
            font-size: 11pt;
            line-height: 16pt;
        }
        .xac-nhan-sign .bs-date { font-style: italic; margin-bottom: 3px; white-space: nowrap; }
        .xac-nhan-sign .bs-title { font-weight: bold; font-size: 12pt; white-space: nowrap; }
        .xac-nhan-sign .bs-instr { font-style: italic; font-size: 9pt; }
        .xac-nhan-sign .bs-blank { height: 65px; }
        .xac-nhan-sign .bs-name { font-size: 11pt; }

        /* ===== LƯU Ý (bảng chỉ có viền trên) ===== */
        .tbl-luuy {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        .tbl-luuy td {
            border-top: 1.5pt solid #bfbfbf;
            padding: 4px 6px;
            font-size: 13pt;
            text-align: justify;
            line-height: 14pt;
        }

        /* ===== NÚT IN ===== */
        .print-btn {
            position: fixed;
            top: 16px;
            right: 20px;
            padding: 8px 18px;
            background: #1e40af;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13pt;
            font-family: sans-serif;
            z-index: 999;
            box-shadow: 0 2px 6px rgba(0,0,0,.3);
        }
    </style>
</head>
<body>

<button class="print-btn no-print" onclick="window.print()">🖨 In đơn</button>

@php
    $gioiDan  = $application->gioiDan;
    $tinh     = $gioiDan?->tinh;
    $tinhName = $tinh?->name ?? '…………………………………';
    $danName  = $gioiDan?->name ?? '……………………………………………………';
    $dl       = $gioiDan?->start_date?->year ?? '20…';
    $pl       = $gioiDan?->start_date ? ($gioiDan->start_date->year + 544) : '25…';
@endphp

{{-- ===== MÃ MẪU (góc trên phải) ===== --}}
<div class="mau-code-top">Mẫu TN17</div>

{{-- ===== HEADER TABLE ===== --}}
<table class="tbl">
    <tr>
        <td class="col-left" style="width:43%">
            GIÁO HỘI PHẬT GIÁO VIỆT NAM<br>
            TỈNH: {{ $tinhName }}<br>
            <span class="ban-tri-su">BAN TRỊ SỰ</span><br>
            <span class="dai-gioi-dan">ĐẠI GIỚI ĐÀN</span><br>
            <span class="dan-name">{{ $danName }}</span><br>
            <span class="pl-dl">PL.{{ $pl }} - DL.{{ $dl }}</span>
        </td>
        <td class="col-right">
            <span class="cong-hoa">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</span><br>
            <span class="doc-lap">Độc lập - Tự do - Hạnh phúc</span><br>
            <br>
            <br>
        </td>
    </tr>
</table>

{{-- ===== SECTION: ẢNH TRÁI + TIÊU ĐỀ/KÍNH GỬI PHẢI ===== --}}
<table class="section-title-wrap">
    <tr>
        <td class="col-photo-left">
            <div class="photo-box">
                @if($application->photo_path)
                    <img src="{{ asset('storage/' . $application->photo_path) }}" alt="Ảnh">
                @else
                    <div>Ảnh<br>3 x 4</div>
                    <div style="font-size:8pt;margin-top:4px;font-style:italic;">(chụp chính<br>diện, nền trắng)</div>
                @endif
            </div>
        </td>
        <td class="col-content-right">
            <div class="doc-title">ĐƠN XIN THỌ GIỚI TỲ KHEO</div>

            <div class="kinh-gui">
                <span style="text-decoration:underline;font-style:italic;">Kính gửi:</span>
                <strong> - BAN TRỊ SỰ GIÁO HỘI PHẬT GIÁO VIỆT NAM;</strong><br>
                - <strong>BAN TỔ CHỨC ĐẠI GIỚI ĐÀN '{{ $danName }}"</strong><br>
                <strong>PL.{{ $pl }}… - DL.{{ $dl }}…</strong>
            </div>

            <div class="kinh-gui-tinh">
                TỈNH :{{ $tinhName }}
            </div>
        </td>
    </tr>
</table>
<br>

{{-- ===== TRƯỜNG THÔNG TIN ===== --}}
<div class="fields">

    <div class="fr">
        <span class="fl">Thế danh <span class="fl-i">(chữ in hoa)</span>:</span>
        <span class="fv">{{ mb_strtoupper($application->full_name) }}</span>
    </div>

    <div class="fr">
        <span class="fl">Pháp danh <span class="fl-i">(chữ in hoa)</span>:</span>
        <span class="fv">{{ mb_strtoupper($application->dharma_name ?? '') }}</span>
    </div>

    <div class="fr-2col">
        <div class="fr">
            <span class="fl">Ngày/tháng/năm sinh:</span>
            <span class="fv">{{ $application->birth_date->format('d/m/Y') }}</span>
        </div>
        <div class="fr">
            <span class="fl">tại:</span>
            <span class="fv">{{ $application->native_place ?? '' }}</span>
        </div>
    </div>

    <div class="fr-2col">
        <div class="fr">
            <span class="fl">CCCD số:</span>
            <span class="fv">{{ $application->id_card_number ?? '' }}</span>
        </div>
        <div class="fr" style="flex:0.7">
            <span class="fl">Ngày cấp:</span>
            <span class="fv">{{ $application->id_card_date?->format('d/m/Y') ?? '' }}</span>
        </div>
    </div>

    <div class="fr">
        <span class="fl">Địa chỉ thường trú <span class="fl-i">(ghi rõ tên Tự viện)</span>:</span>
        <span class="fv">{{ $application->permanent_address ?? '' }}</span>
    </div>

    <div class="fr" style="font-size:13pt;">
        <span class="fl">Hiện tu học <span class="fl-i">(ghi rõ tên Tự viện và địa chỉ)</span>:</span>
        <span class="fv">{{ $application->current_residence ?? $application->temple_name ?? '' }}</span>
    </div>

    <div class="fr-2col">
        <div class="fr">
            <span class="fl">Ngày/tháng/năm thọ giới Sa di:</span>
            <span class="fv">{{ $application->sa_di_ordain_date?->format('d/m/Y') ?? '' }}</span>
        </div>
        <div class="fr">
            <span class="fl">tại Giới đàn Tôn hiệu:</span>
            <span class="fv">{{ $application->sa_di_gioi_dan ?? '' }}</span>
        </div>
    </div>

    <div class="fr">
        <span class="fl">Do Ban Trị sự GHPGVN Tỉnh:</span>
        <span class="fv" style="flex:0; min-width:120px;">{{ $application->sa_di_tinh ?? '' }}</span>
        <span class="fl">&nbsp;tổ chức.</span>
    </div>

    <div class="fr" style="font-size:13pt;">
        <span class="fl">Bổn sư <span class="fl-i">(ghi rõ phẩm vị, pháp danh và địa chỉ Tự viện)</span>:</span>
        <span class="fv">{{ $application->master_name ?? '' }}</span>
    </div>
    <div class="extra-line">{{ $application->temple_name ?? '' }}</div>

    <div class="fr">
        <span class="fl">Trình độ văn hóa:</span>
        <span class="fv">{{ $application->education_level ?? '' }}</span>
    </div>
    <div class="fr">
        <span class="fl">Trình độ Phật học:</span>
        <span class="fv">{{ $application->buddhist_education ?? '' }}</span>
    </div>

</div>

{{-- ===== NỘI DUNG ĐƠN ===== --}}
<p class="body-para">
    Nay con kính xin Ban Thường trực Ban Trị sự GHPGVN Tỉnh: <strong>{{ $tinhName }}</strong>, Ban Tổ chức Đại Giới đàn Tôn hiệu "<strong>{{ $danName }}</strong>" PL.{{ $pl }} - DL.{{ $dl }} chấp thuận cho con được đăng ký vào hàng Giới tử, phát nguyện thọ giới <strong>TỲ KHEO</strong>.
</p>
<p class="body-para" style="text-indent:0;">
    Con thành kính tri ân và kính chúc quý Tôn đức thân tâm an lạc, Phật sự viên thành./.
</p>

{{-- ===== BẢNG THỦ TỤC + KÝ TÊN ===== --}}
<table class="tbl tbl-bottom">
    <tr>
        <td class="col-thutuc" style="width:52%">
            <strong>* <span style="text-decoration:underline;">Thủ tục đính kèm:</span></strong>
            <ul>
                <li>01 Sơ yếu lý lịch <em>(mẫu TN01)</em>;</li>
                <li>01 Bản sao Chứng điệp thọ giới Sa di <em>(có thị thực)</em>;</li>
                <li>01 Bản sao Bằng tốt nghiệp THPT <em>(có thị thực)</em>;</li>
                <li>01 Bản sao Chứng chỉ Trung cấp Phật học <em>(có thị thực)</em>;</li>
                <li>01 Bản sao CCCD <em>(có thị thực)</em>;</li>
                <li>01 Giấy khám sức khỏe;</li>
                <li>03 Ảnh 3×4<br>
                    <em>(Ảnh chụp không quá 6 tháng, nền trắng, chính diện)</em>
                </li>
            </ul>
            <div class="luu-y">* Đối với các Giới tử trên 30 tuổi được miễn yêu cầu bằng tốt nghiệp THPT và Phật học.</div>
        </td>
        <td class="col-kinhdon">
            <div class="date-line">…………………, ngày &ensp;…… tháng &ensp;…… năm 20……</div>
            <div class="kd-title">Kính đơn</div>
            <div class="kd-instr">(ký tên, ghi rõ pháp danh và thế danh)</div>
            <div class="kd-blank"></div>
            <div class="kd-name">
                …………………………………………..………...<br>
                …………………………………………………….
            </div>
        </td>
    </tr>
</table>

{{-- ===== XÁC NHẬN BỔN SƯ ===== --}}
<div class="xac-nhan-title">XÁC NHẬN CỦA BỔN SƯ/ TRỤ TRÌ/ TRƯỞNG BAN QUẢN TRỊ</div>
<div class="xac-nhan-blank"></div>
<div class="xac-nhan-sign">
    <div class="bs-date">……………………, ngày &ensp;…… tháng &ensp;…… năm 20……</div>
    <div class="bs-title">BỔN SƯ/ TRỤ TRÌ/ TRƯỞNG BAN QUẢN TRỊ</div>
    <div class="bs-instr">(ký tên &amp; đóng dấu)</div>
    <div class="bs-blank"></div>
    <div class="bs-name">…………………………………………………</div>
</div>

{{-- ===== LƯU Ý (bảng chỉ viền trên) ===== --}}
<table class="tbl-luuy">
    <tr>
        <td>
            <strong>* Lưu ý</strong>: Đối với các Giới tử ngoài tỉnh, phải có văn bản xác nhận, giới thiệu của Ban Trị sự GHPGVN cấp Tỉnh nơi đang cư trú tu học.
        </td>
    </tr>
</table>


</body>
</html>

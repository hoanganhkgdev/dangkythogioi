<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>In Đơn Đăng Ký - {{ $application->full_name }}</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; font-size: 14pt; line-height: 1.5; padding: 1cm; }
        .header { text-align: center; font-weight: bold; margin-bottom: 20px; }
        .title { text-align: center; font-size: 18pt; font-weight: bold; margin-bottom: 30px; }
        .section-title { font-weight: bold; margin-top: 20px; text-decoration: underline; }
        .info-row { margin-bottom: 10px; }
        .label { display: inline-block; width: 220px; }
        .signatures { margin-top: 50px; display: flex; justify-content: space-between; text-align: center; }
        .signature-box { width: 30%; font-style: italic; }
        .qr-code { float: right; margin-top: -100px; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        GIÁO HỘI PHẬT GIÁO VIỆT NAM<br>
        BAN TRỊ SỰ GHPGVN TỈNH/THÀNH PHỐ ....................
    </div>

    <div class="title">
        ĐƠN XIN THỌ GIỚI {{ mb_strtoupper($application->ordination_level) }}
    </div>

    <div class="info-row"><span class="label">Kính gửi:</span> Ban Trị Sự GHPGVN tỉnh ....................</div>
    
    <div class="info-row"><span class="label">Tôi tên là (Khai sinh):</span> <strong>{{ $application->full_name }}</strong></div>
    <div class="info-row"><span class="label">Pháp danh:</span> {{ $application->dharma_name }}</div>
    <div class="info-row"><span class="label">Ngày sinh:</span> {{ $application->birth_date->format('d/m/Y') }}</div>
    <div class="info-row"><span class="label">Giới tính:</span> {{ $application->gender }}</div>
    <div class="info-row"><span class="label">Số CCCD:</span> {{ $application->id_card_number }}</div>
    <div class="info-row"><span class="label">Hòa thượng Bổn sư:</span> {{ $application->master_name }}</div>
    <div class="info-row"><span class="label">Chùa hiện đang tu học:</span> {{ $application->temple_name }}</div>
    <div class="info-row"><span class="label">Trình độ văn hóa:</span> {{ $application->education_level }}</div>
    <div class="info-row"><span class="label">Trình độ Phật học:</span> {{ $application->buddhist_education }}</div>

    <div style="margin-top: 20px;">
        Nay tôi phát tâm dõng mãnh, nguyện thọ nhận giới pháp {{ $application->ordination_level }} để tiến bước trên con đường tu học, phụng sự Đạo pháp và Dân tộc. 
        Kính xin Ban Trị Sự xem xét và chấp thuận.
    </div>

    <div class="signatures">
        <div class="signature-box">
            <strong>Y KIẾN BỔN SƯ</strong><br>
            (Ký và ghi rõ họ tên)
        </div>
        <div class="signature-box">
            <strong>NGƯỜI LÀM ĐƠN</strong><br>
            (Ký và ghi rõ họ tên)
        </div>
    </div>

    <div style="margin-top: 100px; font-size: 10pt; color: gray;">
        Mã hồ sơ: #{{ $application->id }} | Tra cứu tại: {{ url('/') }}
    </div>
</body>
</html>

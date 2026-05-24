@extends('frontend.layout')

@section('content')
<style>
    .detail-page {
        background: linear-gradient(rgba(0, 28, 45, 0.35), rgba(0, 28, 45, 0.45)),
        url("{{ asset('frontend/img/bgberanda.png') }}") top center / cover no-repeat;
        min-height: calc(100vh - 75px);
        color: white;
        padding: 45px 20px 80px;
    }

    .detail-container {
        width: 100%;
        max-width: 1050px;
        margin: 0 auto;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: white;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .back-link i {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.55);
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .detail-card {
        width: 100%;
        background: #138bb0;
        border-radius: 16px;
        padding: 38px 44px;
        display: grid;
        grid-template-columns: 320px minmax(0, 1fr);
        gap: 40px;
        align-items: center;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.35);
    }

    .image-box {
        width: 100%;
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-image {
        width: 100%;
        max-width: 280px;
        max-height: 320px;
        object-fit: contain;
    }

    .detail-info {
        min-width: 0;
    }

    .detail-title {
        font-size: clamp(24px, 4vw, 32px);
        line-height: 1.25;
        font-weight: 800;
        margin-bottom: 18px;
        word-break: break-word;
    }

    .detail-desc {
        font-size: 15px;
        line-height: 1.6;
        max-width: 560px;
        margin-bottom: 20px;
    }

    .divider {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.6);
        margin: 20px 0;
    }

    .original {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .original i {
        font-size: 18px;
    }

    .jumlah-label {
        margin-bottom: 8px;
        font-size: 13px;
    }

    .action-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .qty-box {
        display: flex;
        width: 130px;
        height: 40px;
        border: 1px solid white;
        border-radius: 6px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .qty-box button,
    .qty-box input {
        width: 33.33%;
        border: none;
        background: transparent;
        color: white;
        text-align: center;
        font-size: 16px;
        outline: none;
    }

    .qty-box button {
        cursor: pointer;
    }

    .buy-btn {
        height: 40px;
        width: 180px;
        background: #1d3557;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
    }

    .cart-btn {
        height: 40px;
        padding: 0 16px;
        background: transparent;
        color: white;
        border: 1px solid white;
        border-radius: 6px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
    }

    .buy-btn:hover {
        background: #10243e;
    }

    .cart-btn:hover {
        background: white;
        color: #138bb0;
    }

    @media (max-width: 850px) {
        .detail-card {
            grid-template-columns: 1fr;
            gap: 24px;
            padding: 30px 24px;
            text-align: center;
        }

        .image-box {
            min-height: auto;
        }

        .detail-desc {
            margin-left: auto;
            margin-right: auto;
        }

        .original {
            justify-content: center;
        }

        .action-row {
            justify-content: center;
        }
    }

    @media (max-width: 520px) {
        .detail-page {
            padding: 28px 14px 60px;
        }

        .detail-card {
            padding: 24px 16px;
        }

        .detail-image {
            max-width: 230px;
            max-height: 250px;
        }

        .action-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .qty-box,
        .buy-btn,
        .cart-btn {
            width: 100%;
        }
    }
</style>

<section class="detail-page">
    <div class="detail-container">
        <a href="{{ route('frontend.products.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali Ke Katalog
        </a>

        <div class="detail-card">
            <div class="image-box">
                @if($product->foto)
                <img class="detail-image" src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_barang }}">
                @else
                <img class="detail-image" src="{{ asset('frontend/img/no-image.png') }}" alt="No Image">
                @endif
            </div>

            <div class="detail-info">
                <div class="detail-title">
                    {{ $product->nama_barang }}<br>
                    Rp. {{ number_format($product->harga_jual, 0, ',', '.') }}
                </div>

                <div class="detail-desc">
                    {{ $product->deskripsi ?? 'Produk berkualitas dari BlueLight Aquarium.' }}
                </div>

                <hr class="divider">

                <div class="original">
                    <i class="fas fa-certificate"></i>
                    <span>100% Original</span>
                </div>

                <form id="detailForm" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="jumlah-label">Jumlah</div>

                    <div class="action-row">
                        <div class="qty-box">
                            <button type="button" onclick="minusQty()">-</button>
                            @php
                            $stok = $product->stock->stok ?? 0;
                            @endphp

                            <input type="text" name="jumlah" id="qtyInput" value="1" data-stok="{{ $stok }}" readonly>
                            <button type="button" onclick="plusQty()">+</button>
                        </div>

                        <button type="button" class="buy-btn" onclick="buyNow()">
                            Beli Sekarang
                        </button>

                        <button type="button" class="cart-btn" onclick="addToCart()">
                            <i class="fas fa-shopping-cart"></i> Masukkan Keranjang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function plusQty() {
        const input = document.getElementById('qtyInput');
        const stok = parseInt(input.dataset.stok);
        const jumlah = parseInt(input.value);

        if (jumlah >= stok) {
            alert('Stok tidak cukup. Stok tersedia hanya ' + stok + ' item.');
            return;
        }

        input.value = jumlah + 1;
    }

    function minusQty() {
        const input = document.getElementById('qtyInput');

        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function addToCart() {
        const form = document.getElementById('detailForm');
        form.action = "{{ route('cart.add') }}";
        form.submit();
    }

    function buyNow() {
        const form = document.getElementById('detailForm');
        form.action = "{{ route('cart.add') }}?redirect=checkout";
        form.submit();
    }
</script>
@endsection
@extends('layouts.base')

@section('body')
            <div class="component">

                <h2>Ko zove danas?</h2>
                <!-- Start Nav Structure -->
                <button class="cn-button" id="cn-button">NISAM!</button>
                <div class="cn-wrapper" id="cn-wrapper">
                    <ul>
                        @foreach ($users as $user)
                            <li><a href="#"><span>{{ $user->name }}<small>({{ $user->countOrders }})</small></span></a></li>
                        @endforeach
                     </ul>

                </div>
                <!-- End of Nav Structure -->

            </div>

            <header>
                <h1>{{$nextUser->name}}! <span>Na tebi je red da naručiš</span></h1>
                <nav class="codrops-demos">
                    {!! Form::open(array('route' => 'main.create','id' => 'order-form')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <textarea class="area_better" rows="4" cols="50" type="text" name="desc" id="desc"></textarea><br>
                     <a href="#" onclick="document.getElementById('order-form').submit();">Naruci!</a>
                    {!! Form::close() !!}
                </nav>
            </header>

            <section>
            @foreach ($orders as $order)
                <p>{{$order->userFull->name}} - {{$order->desc}}</p>
            @endforeach
                <p>Soko leek tomatillo quandong winter purslane caulie jícama daikon dandelion bush tomato. Daikon cress amaranth leek cabbage black-eyed pea kakadu plum scallion watercress garbanzo gram caulie welsh onion water spinach tomatillo groundnut desert raisin. Wakame salsify bunya nuts spring onion lotus root prairie turnip fennel onion dandelion black-eyed pea bok choy zucchini taro. Jícama collard greens amaranth bell pepper catsear brussels sprout sweet pepper daikon spring onion aubergine broccoli rabe quandong mustard celery corn groundnut peanut. Mung bean fennel eggplant water spinach bunya nuts sierra leone bologi epazote okra caulie groundnut black-eyed pea parsnip fava bean squash.</p>
                <p>Parsnip tomatillo swiss chard garbanzo gourd potato silver beet. Celery swiss chard melon zucchini arugula pea quandong beet greens radish artichoke black-eyed pea endive winter purslane horseradish garlic amaranth collard greens chickpea. Rock melon pumpkin collard greens celery broccoli rabe endive nori brussels sprout gourd courgette sea lettuce artichoke desert raisin coriander chard.</p>
                <p>Collard greens ricebean horseradish wattle seed chard epazote potato peanut gram earthnut pea spinach yarrow desert raisin salad mung bean summer purslane fennel. Water spinach celery cucumber grape cauliflower nori daikon sweet pepper endive lentil turnip greens catsear leek beet greens. Melon seakale parsnip soybean bamboo shoot fennel scallion. Coriander groundnut squash corn aubergine bitterleaf azuki bean dandelion courgette broccoli rabe. Chickweed salsify chickweed groundnut nori okra lentil water spinach rock melon broccoli. Soko leek tomatillo quandong winter purslane caulie jícama daikon dandelion bush tomato. Daikon cress amaranth leek cabbage black-eyed pea kakadu plum scallion watercress garbanzo gram caulie welsh onion water spinach tomatillo groundnut desert raisin. Wakame salsify bunya nuts spring onion lotus root prairie turnip fennel onion dandelion black-eyed pea bok choy zucchini taro. Jícama collard greens amaranth bell pepper catsear brussels sprout sweet pepper daikon spring onion aubergine broccoli rabe quandong mustard celery corn groundnut peanut. Mung bean fennel eggplant water spinach bunya nuts sierra leone bologi epazote okra caulie groundnut black-eyed pea parsnip fava bean squash.</p>
                <p>Parsnip tomatillo swiss chard garbanzo gourd potato silver beet. Celery swiss chard melon zucchini arugula pea quandong beet greens radish artichoke black-eyed pea endive winter purslane horseradish garlic amaranth collard greens chickpea. Rock melon pumpkin collard greens celery broccoli rabe endive nori brussels sprout gourd courgette sea lettuce artichoke desert raisin coriander chard.</p>
                <p>Collard greens ricebean horseradish wattle seed chard epazote potato peanut gram earthnut pea spinach yarrow desert raisin salad mung bean summer purslane fennel. Water spinach celery cucumber grape cauliflower nori daikon sweet pepper endive lentil turnip greens catsear leek beet greens. Melon seakale parsnip soybean bamboo shoot fennel scallion. Coriander groundnut squash corn aubergine bitterleaf azuki bean dandelion courgette broccoli rabe. Chickweed salsify chickweed groundnut nori okra lentil water spinach rock melon broccoli.</p>
            </section>

        <script src="js/demo2.js"></script>
@stop

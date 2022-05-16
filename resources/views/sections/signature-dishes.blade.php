<section class="dishes">

    <h2 class="text-center">SIGNATURE DISH OF:</h2>

    @php $dishes = epicure_dishes_list($dishes_per_page) @endphp


    <ul class="dishes-list">
        @foreach ($dishes as $dish)
            <li class="dish-card text-center">

                <x-dish-card restaurant="{{ @$dish->restaurant[0]->post_title }}" source="{{ $dish->image_src }}"
                    width="{{ $dish->image_width }}" name="{{ $dish->name }}"
                    ingredients="{{ $dish->ingredients }}" price="{{ $dish->price }}" :types="$dish->dish_types" />

            </li>
        @endforeach
    </ul>



</section>

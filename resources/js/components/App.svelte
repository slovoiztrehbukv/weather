<script>
	import { onMount } from "svelte";
    import {
        Button,
        Input,
        Menu,
        MenuItem,
        Select,
    } from 'agnostic-svelte';
    import 'agnostic-svelte/css/common.min.css';

    let city = ''

    const cities = [
        {
            label: 'Saint-Petersburg',
            value: 'spb',
        },
        {
            label: 'Moscow',
            value: 'moscow',
        },
        {
            label: 'New-York',
            value: 'ny',
        },
        {
            label: 'Dubai',
            value: 'dubai',
        },
        {
            label: 'ElseCity',
            value: 'else',
        },
    ]

    const updateData = val => {
        fetch(`/api/weather/${val}`)
            .then(res => res.text())
            .then(res => city = res)
    }

    onMount(() => {
        //
	});
</script>

<main>
	<div class="container white">
		<h1>Weather</h1>
		<h2>choose a city</h2>
		<div class="search-box">
			<div class="search-icon"><i class="fa fa-search search-icon"></i></div>
                <Select
                    bind:selected={city}
                    on:selected={(e) => updateData(e.detail)}
                    uniqueId="sel1"
                    name="select1"
                    labelCopy="Select the best tennis player of all time"
                    options={cities}
                />
			<div class="go-icon"><i class="fa fa-arrow-right"></i></div>
		</div>
	</div>
</main>

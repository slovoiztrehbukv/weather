<script>
	import { onMount } from "svelte";
    import Select from 'svelte-select';
    import 'agnostic-svelte/css/common.min.css';

    async function getCities(filterText) {
        return (await fetch(`/api/cities?q=${filterText}`)).json();
    }

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
	<div class="container">
		<h1>Weather</h1>
		<h2>choose a city</h2>
        <Select loadOptions={getCities} />
	</div>
</main>

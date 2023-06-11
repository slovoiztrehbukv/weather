<script>
    import { onMount } from 'svelte';
    import { Table } from "agnostic-svelte";
    import Select from 'svelte-select';
    import 'agnostic-svelte/css/common.min.css';

    const createRow = (
        title,
        day1,
        day2,
        day3,
        day4,
        day5,
        day6,
        day7
    ) => ({
        title,
        day1,
        day2,
        day3,
        day4,
        day5,
        day6,
        day7
    });

    let tableArgs = {
        headers: [],
        rows: [],
    }


    async function getCities(filterText) {
        return (await fetch(`/api/cities?q=${filterText}`)).json();
    }

    const updateData = val => {
        const [lat, lon] = val.split('|')

        fetch(`/api/weather/one-week`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({
                lat,
                lon,
            })
        })
            .then(res => res.json())
            .then(rows => {tableArgs.rows = rows.map(r => createRow(r.name, ...r.data))})
    }

    onMount(() => {
        fetch(`/api/weather/one-week/headers`)
            .then(res => res.json())
            .then(headers => {tableArgs.headers = headers})
    })
</script>

<main>
	<div class="container">
		<h1>Weather</h1>
		<h2>choose a city</h2>
        <div class="black">
            <Select
                loadOptions={getCities}
                on:select={e => updateData(e.detail.value)}
            />
        </div>
        <div class="bg-white mt-2 p-1">
            <Table {...tableArgs} />
        </div>
	</div>
</main>

<script>
    import { Table } from "agnostic-svelte";
    import Select from 'svelte-select';
    import 'agnostic-svelte/css/common.min.css';

    let loaded = false

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
        rows: [],
        headers: [
            {
                label: 'service',
                key: 'service',
                sortable: false,
            },
            {
                label: 'day1',
                key: 'day1',
                sortable: false,
            },
            {
                label: 'day2',
                key: 'day2',
                sortable: false,
            },
            {
                label: 'day3',
                key: 'day3',
                sortable: false,
            },
            {
                label: 'day4',
                key: 'day4',
                sortable: false,
            },
            {
                label: 'day5',
                key: 'day5',
                sortable: false,
            },
            {
                label: 'day6',
                key: 'day6',
                sortable: false,
            },
            {
                label: 'day7',
                key: 'day7',
                sortable: false,
            },
        ]
    }


    async function getCities(filterText) {
        return (await fetch(`/api/cities?q=${filterText}`)).json();
    }

    const updateData = val => {
        const [lat, lon] = val.split('|')

        fetch(`/api/weather`, {
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
            .then(res => {
                tableArgs.rows = Object.entries(res)
                    .map(
                        ([s, {data}]) => createRow(s, ...Object.values(data).map(v => v.temp))
                    )
            })
    }
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
        <div>
            <Table {...tableArgs} />
        </div>
	</div>
</main>

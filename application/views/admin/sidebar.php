<ul class="list-group mb-4">
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/admin/dashboard">Начална страница</a>
	</li>
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/users">Потребители</a>
		<span class="badge badge-primary badge-pill count-users"></span>
	</li>
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/firms">Фирми</a>
		<span class="badge badge-primary badge-pill count-firms"></span>
	</li>
	<!-- <li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/cities">Градове</a>
		<span class="badge badge-primary badge-pill count-cities"></span>
	</li> -->
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/activities">Дейности</a>
		<span class="badge badge-primary badge-pill count-activities"></span>
	</li>
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/ads">Обяви</a>
		<span class="badge badge-primary badge-pill count-ads"></span>
	</li>
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/offers">Предложения</a>
		<span class="badge badge-primary badge-pill count-offers"></span>
	</li>
	<!-- <li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/messages">Съобщения</a>
		<span class="badge badge-primary badge-pill count-messages"></span>
	</li> -->
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/deals">Сделки</a>
		<span class="badge badge-primary badge-pill count-deals"></span>
	</li>
	<!-- <li class="list-group-item d-flex justify-content-between align-items-center">
		<a href="/feedbacks">Обратни връзки</a>
		<span class="badge badge-primary badge-pill count-feedback"></span>
	</li> -->
</ul>

<script src="/assets/js/dashboard.js"></script>
<script type="text/javascript">
	jQuery(function() {
			Dashboard.getCount();
		});
</script>
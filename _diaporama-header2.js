		countArticle = 0;
		var mySlideData = new Array();

				mySlideData[countArticle++] = new Array(
			'photos/diapo2021-01.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo2021-02.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo2021-03.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo2021-04.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo2021-05.jpg',
			'',
			'',
			''
			);
			mySlideData[countArticle++] = new Array(
				'photos/diapo2021-06.jpg',
				'',
				'',
				''
				)
			mySlideData[countArticle++] = new Array(
				'photos/diapo2021-07.jpg',
				'',
				'',
				''
			)
			mySlideData[countArticle++] = new Array(
				'photos/diapo2022-01.jpg',
				'',
				'',
				''
			)
		function addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
		window.onload = func;
		} else {
		window.onload = function() {
		oldonload();
		func();
		} } }

		function startSlideshow() {
		initSlideShow($('mySlideshow'), mySlideData);
		}
		addLoadEvent(startSlideshow);


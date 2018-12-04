    var granimInstance = new Granim({
        name: 'main-gradient',
        element: '#granim-canvas',
         direction: 'radial',
        isPausedWhenNotInView: true,
        opacity: [1, 1],
        stateTransitionSpeed: 1000,
        states : {
            "default-state": {
                gradients: [
                    ['#AA076B', '#61045F'],
                    ['#02AAB0', '#00CDAC'],
                    ['#DA22FF', '#9733EE']
                ],
            },
        }
    });
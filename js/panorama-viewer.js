(function ($) {
    $.fn.panoramaView = function (items) {
        this.each(function () {
            let canvas = document.createElement("canvas");
            let gl = null;

            try {
                gl = canvas.getContext("webgl");
            } catch (x) {
                gl = null;
            }

            if (gl === null) {
                try {
                    gl = canvas.getContext("experimental-webgl");
                } catch (x) {
                    gl = null;
                }
            }

            if (gl) {
                if ($(this).data("processed") !== true) {
                    $(this).data("lat", 0);
                    $(this).data("lon", 0);
                    $(this).data("onPointerDownPointerX", 0);
                    $(this).data("onPointerDownPointerY", 0);
                    $(this).data("isUserInteracting", false);

                    $(this).data("camera", new THREE.PerspectiveCamera(75, 16 / 9, 1, 1100));
                    $(this).data("camera").target = new THREE.Vector3(0, 0, 0);
                    $(this).data("scene", new THREE.Scene());

                    let geometry = new THREE.SphereGeometry(500, 60, 40);

                    geometry.scale(-1, 1, 1);

                    let material = new THREE.MeshBasicMaterial({
                        map: new THREE.TextureLoader().load($(this).data("panorama-picture"))
                    });

                    $(this).data("scene").add(new THREE.Mesh(geometry, material));
                    $(this).data("renderer", new THREE.WebGLRenderer());
                    $(this).data("renderer").setPixelRatio(window.devicePixelRatio);
                    $(this).data("renderer").setSize($(this).width(), $(this).width() * 9 / 16);
                    $(this).get(0).setAttribute("style", "height: " + $(this).width() * 9 / 16 + "px");
                    $(this).get(0).appendChild($(this).data("renderer").domElement);

                    $(this).bind('mousedown', function (event) {
                        event.preventDefault();
                        $(this).data("isUserInteracting", true);
                        $(this).data("onPointerDownPointerX", event.clientX);
                        $(this).data("onPointerDownPointerY", event.clientY);
                        $(this).data("onPointerDownLon", $(this).data("lon"));
                        $(this).data("onPointerDownLat", $(this).data("lat"));
                    });

                    $(this).bind('mousemove', function (event) {
                        if ($(this).data("isUserInteracting") === true) {
                            $(this).data("lon", ($(this).data("onPointerDownPointerX") - event.clientX) * 0.1 + $(this).data("onPointerDownLon"));
                            $(this).data("lat", (event.clientY - $(this).data("onPointerDownPointerY")) * 0.1 + $(this).data("onPointerDownLat"));
                        }
                    });

                    $(this).bind('mouseup', function () {
                        $(this).data("isUserInteracting", false);
                    });

                    $(this).data("processed", true);
                }
            } else {
                $(this).html("<div class=\"well\">" + $(this).data("alternative-message") + "</div>");
            }
        });

        let myRenderFunc = function () {
            requestAnimationFrame(myRenderFunc);

            $(".panorama-viewer").each(function () {
                if ($(this).data("isUserInteracting") === false) {
                    $(this).data("lon", $(this).data("lon") + 0.1);
                }

                $(this).data("lat", Math.max(-85, Math.min(85, $(this).data("lat"))));
                $(this).data("phi", THREE.Math.degToRad(90 - $(this).data("lat")));
                $(this).data("theta", THREE.Math.degToRad($(this).data("lon")));
                $(this).data("camera").target.x = 500 * Math.sin($(this).data("phi") * Math.cos($(this).data("theta")));
                $(this).data("camera").target.y = 500 * Math.cos($(this).data("phi"));
                $(this).data("camera").target.z = 500 * Math.sin($(this).data("phi") * Math.sin($(this).data("theta")));
                $(this).data("camera").lookAt($(this).data("camera").target);
                $(this).data("renderer").render($(this).data("scene"), $(this).data("camera"));
            });
        };

        myRenderFunc();

        $(window).resize(function () {
            $(".panorama-viewer").each(function () {
                if ($(this).data("processed")) {
                    $(this).data("camera").aspect = 16 / 9;
                    $(this).data("camera").updateProjectionMatrix();
                    $(this).data("renderer").setSize($(this).width(), $(this).width() * 9 / 16);
                    $(this).get(0).setAttribute("style", "height: " + $(this).width() * 9 / 16 + "px");
                }
            });

        });

        return this;
    };
}(jQuery));
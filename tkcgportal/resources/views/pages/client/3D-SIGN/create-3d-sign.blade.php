@extends('layout.default')
@section('title', '3D Sign Designer')
@section('content')
<style>
    .camera-btn {
      @apply py-2 px-4 text-sm font-medium rounded-xl shadow-md transition-all duration-200 ease-in-out min-w-[100px] hover:scale-105 hover:brightness-110;
    }
    </style>
    
    <div class="w-full">
        <div class="w-full">
            <div class="flex justify-between items-center mt-[60px] pb-[20px]">
                <div class="list-header">
                    <div class="flex items-center justify-start">
                        <a href="{{route('client.project.list')}}" class="p-1"><img
                                src="{{asset('public/images/arrow.svg')}}" alt="Back Button" class="w-[20px]"></a>
                        <h2 class="font-normal text-2xl">3D Sign Designer</h2>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white rounded-md">
                <div class="w-full flex gap-2">
                    <div class="w-1/2">
                        <!-- Tabs Navigation -->
                        <div class="w-full flex mb-6 gap-2">
                            <button onclick="showTab('cabinet-settings')"
                                class="py-2 px-4 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition duration-200">Cabinet</button>
                            <button onclick="showTab('post-settings')"
                                class="py-2 px-4 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition duration-200">Posts</button>
                            <button onclick="showTab('footing-settings')"
                                class="py-2 px-4 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition duration-200">Footing</button>
                            <button onclick="showTab('baseplate-settings')"
                                class="py-2 px-4 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition duration-200">Baseplate</button>
                        </div>

                        <!-- Sign Builder Controls Section -->
                        <div class="w-full flex flex-wrap gap-8">
                            <!-- Left Panel (Cabinet Options and Footing/Post Settings) -->
                            <div class="w-full md:w-1/2">

                                <!-- Cabinet Settings Tab Content -->
                                <div id="cabinet-settings" class="tab-content w-full">
                                    <div class="mb-8">
                                        <div class="flex justify-between gap-2">
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="cabinet-width" class="block font-bold text-gray-700">Width
                                                    (ft)</label>
                                                <input id="cabinet-width" type="text" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>

                                            <div class="input-group w-1/2 mb-4">
                                                <label for="cabinet-height" class="block font-bold text-gray-700">Height
                                                    (ft)</label>
                                                <input id="cabinet-height" type="text" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                        </div>
                                        <div class="flex justify-between gap-2">
                                            <div class="input-group w-full mb-4">
                                                <label for="cabinet-depth" class="block font-bold text-gray-700">Depth
                                                    (ft)</label>
                                                <input id="cabinet-depth" type="text" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                        </div>

                                        <div class="input-group w-1/2 mb-4">
                                            <label for="cabinet-color" class="block font-bold text-gray-700">Color</label>
                                            <input id="cabinet-color" type="color" value="#c5e4d4"
                                                class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none">
                                        </div>

                                        <div class="flex justify-between gap-2">
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="front-image-input"
                                                    class="block font-bold text-gray-700 cursor-pointer">Front Image</label>
                                                <input id="front-image-input" type="file"
                                                    class="w-full p-2 border rounded-md cursor-pointer mt-2"
                                                    accept="image/*">
                                            </div>
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="back-image-input"
                                                    class="block font-bold text-gray-700 cursor-pointer">Back Image</label>
                                                <input id="back-image-input" type="file"
                                                    class="w-full p-2 border rounded-md cursor-pointer mt-2"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>

                                <!-- Post Settings Tab Content -->
                                <div id="post-settings" class="tab-content w-full hidden">
                                    <div class="mb-8">
                                        <div class="flex justify-between gap-2">
                                            <div class="input-group w-full mb-4">
                                                <label for="post-shape" class="block font-bold text-gray-700">Shape</label>
                                                <select name="post-shape" id="post-shape"
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none">
                                                    <option value="Square/Rectangular" selected>Square/Rectangular</option>
                                                    <option value="Round">Round</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex justify-between gap-2">
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="post-width" class="block font-bold text-gray-700">Width
                                                    (ft)</label>
                                                <input id="post-width" type="text" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>

                                            <div class="input-group w-1/2 mb-4">
                                                <label for="post-depth" class="block font-bold text-gray-700">Depth
                                                    (ft)</label>
                                                <input id="post-depth" type="text" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                        </div>

                                        <div class="flex justify-between gap-2">
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="post-total-height" class="block font-bold text-gray-700">Total
                                                    Height (ft)</label>
                                                <input id="post-total-height" type="text" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="post-spacing" class="block font-bold text-gray-700">Spacing
                                                    (ft)</label>
                                                <input id="post-spacing" type="text" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                        </div>
                                        <div class="input-group w-1/2 mb-4">
                                            <label for="post-color" class="block font-bold text-gray-700">Color</label>
                                            <input type="color" id="post-color" value="#9c9c9c"
                                                class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none">
                                        </div>
                                    </div>
                                </div>

                                <!-- Footing Settings Tab Content -->
                                <div id="footing-settings" class="tab-content w-full hidden">
                                    <div class="mb-8">
                                        <div class="flex justify-between gap-2">
                                          <div class="input-group w-full mb-4">
                                                <label for="footing-type" class="block font-bold text-gray-700">Type</label>
                                                <select name="footing-type" id="footing-type"
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none">
                                                    <option value="Augered Footing" selected>Augered Footing</option>
                                                    <option value="Spread Footing">Spread Footing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex justify-between gap-2">
                                        <div class="input-group w-1/2 mb-4">
                                            <label for="footing-diameter" class="block font-bold text-gray-700">Diameter
                                                (ft)</label>
                                            <input type="text" id="footing-diameter" value=""
                                                class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                        </div>
                                        <div class="input-group w-1/2 mb-4">
                                            <label for="footing-depth" class="block font-bold text-gray-700">Footing Depth
                                                (ft)</label>
                                            <input type="text" id="footing-depth" value=""
                                                class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                        </div>
                                       </div>
                                    </div>
                                </div>

                                <!-- Baseplate Settings Tab Content -->
                                <div id="baseplate-settings" class="tab-content w-full hidden">
                                    <div class="mb-8">
                                        <div class="flex justify-between gap-2">
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="baseplate-width" class="block font-bold text-gray-700">Width
                                                    (ft)</label>
                                                <input type="text" id="baseplate-width" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="baseplate-length" class="block font-bold text-gray-700">Length
                                                    (ft)</label>
                                                <input type="text" id="baseplate-length" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                        </div>
                                        <div class="flex justify-between gap-2">
                                            <div class="input-group w-full mb-4">
                                                <label for="baseplate-thickness"
                                                    class="block font-bold text-gray-700">Thickness (ft)</label>
                                                <input type="text" id="baseplate-thickness" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                        </div>
                                        <div class="flex justify-between gap-2">
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="anchor-diameter" class="block font-bold text-gray-700">Anchor
                                                    Dia. (in)</label>
                                                <input type="text" id="anchor-diameter" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                            <div class="input-group w-1/2 mb-4">
                                                <label for="anchor-count" class="block font-bold text-gray-700">Anchor
                                                    Count</label>
                                                <input type="text" id="anchor-count" value=""
                                                    class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                            </div>
                                        </div>
                                        <div class="flex justify-between gap-2">
                                        <div class="input-group w-1/2 mb-4">
                                            <label for="embedment" class="block font-bold text-gray-700">Embedment
                                                (in)</label>
                                            <input type="text" id="embedment" value=""
                                                class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-1/2 flex flex-col items-end">
                        <div class="w-full md:w-1/2 p-4">
                            <div id="3d-modal-container" class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                              <button onclick="setCamera('fl-top')" class="camera-btn bg-[#ffb2b2]">FL-Top</button>
                              <button onclick="setCamera('bl-top')" class="camera-btn bg-[#b2ffb2]">BL-Top</button>
                              <button onclick="setCamera('fr-top')" class="camera-btn bg-[#b2d7ff]">FR-Top</button>
                              <button onclick="setCamera('left')" class="camera-btn bg-[#ea4335] text-white">Left</button>
                              <button onclick="setCamera('front')" class="camera-btn bg-[#4285f4] text-white">Front</button>
                              <button onclick="setCamera('right')" class="camera-btn bg-[#34a853] text-white">Right</button>
                              <button onclick="setCamera('bottom')" class="camera-btn bg-[#9e9e9e] text-white">Bottom</button>
                              <button onclick="setCamera('home')" class="camera-btn bg-[#dddddd]">Home</button>
                            </div>
                          </div>
                        <!-- 3D Model Display Section -->
                        <div class="w-full h-[700px] mt-4 overflow-hidden flex justify-center items-center bg-gray-100 border rounded-md">
                            <div id="modalContainer"
                                class="overflow-hidden w-full max-w-full h-full flex justify-center items-center">
                                <!-- Your 3D content or canvas will be centered here -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.add('hidden'));
            const activeTab = document.getElementById(tabId);
            if (activeTab) activeTab.classList.remove('hidden');
        }
        showTab('cabinet-settings');


        $('.number').on('keypress input', function (e) {
            const $input = $(this);
            const value = $input.val();
            const charCode = e.which || e.keyCode;
            if (e.type === "keypress") {
                if ((charCode < 48 || charCode > 57) && charCode !== 46) {
                    e.preventDefault();
                }
                if (charCode === 46 && value.includes('.')) {
                    e.preventDefault();
                }
            }
            if (e.type === "input") {
                let formattedValue = value.replace(/[^0-9.]/g, '');
                let decimalMatch = formattedValue.match(/^\d*\.?\d{0,2}/);
                if (decimalMatch) {
                    formattedValue = decimalMatch[0];
                }
                $input.val(formattedValue);
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mrdoob/three.js@r128/examples/js/exporters/GLTFExporter.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mrdoob/three.js@r128/examples/js/controls/OrbitControls.js"></script>

    <script>
    // === 1. Scene Setup ===
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0xf0f0f0);

    const camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
    camera.position.set(0, 5, 5);

    const renderer = new THREE.WebGLRenderer({ antialias: true });
    const container = document.getElementById("modalContainer");
    renderer.setSize(container.clientWidth, container.clientHeight);
    container.appendChild(renderer.domElement);

    // === 2. Lighting ===
    // Key light (front)
    const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position.set(1, 1, 1);
    scene.add(directionalLight);

    // Fill light (back)
    const backLight = new THREE.DirectionalLight(0xffffff, 0.7);
    backLight.position.set(-1, -1, -1);
    scene.add(backLight);

    // Ambient fill light
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.3);
    scene.add(ambientLight);

    // === 3. Orbit Controls ===
    const controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableZoom = true;
    controls.enablePan = false;
    controls.enableRotate = true;
    controls.target.set(0, 0, 0);
    controls.update();
    controls.maxDistance = 20;
    controls.minPolarAngle = Math.PI / 2;
    controls.maxPolarAngle = Math.PI / 2;

    // === 4. Create Label ===
    function createLabel(text, position) {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        
        const scale = 2, padding = 15;
        const textWidth = context.measureText(text).width;
        canvas.width = (textWidth + padding * 2) * scale;
        canvas.height = 40 * scale;

        context.fillStyle = '#e7e7e7';
        context.fillRect(0, 0, canvas.width, canvas.height);
        context.font = `${12 * scale}px Arial`;
        context.fillStyle = '#000';
        context.fillText(text, (canvas.width - textWidth * scale) / 5, canvas.height / 2 + 7 * scale);

        const texture = new THREE.CanvasTexture(canvas);
        const material = new THREE.SpriteMaterial({ map: texture, transparent: true });
        const label = new THREE.Sprite(material);
        label.position.copy(position);
        label.scale.set(0.5, 0.25, 1);
        scene.add(label);
    }

    // === 5. Groups ===
    let cabinetMesh = null;
    const cabinetGroup = new THREE.Group();
    scene.add(cabinetGroup);

    let postMeshGroup = null;
    const postGroup = new THREE.Group();
    scene.add(postGroup);

    let footingMeshGroup = null;
    const footingGroup = new THREE.Group();
    scene.add(footingGroup);

    let baseplateMesh = null;
    const baseplateGroup = new THREE.Group();
    scene.add(baseplateGroup);

    function createCabinet(width, height, depth, frontImage, backImage, colorHex, postTotalHeight) {
    console.log('colorHex', colorHex);

    // Remove previous cabinet mesh
    if (cabinetMesh) cabinetGroup.remove(cabinetMesh);

    // Remove all labels and lines
    scene.children = scene.children.filter(obj => !(obj instanceof THREE.Sprite || obj instanceof THREE.Line));

    const scale = 0.3;
    const geometry = new THREE.BoxGeometry(width * scale, height * scale, depth * scale);

    const loader = new THREE.TextureLoader();

    function loadTextureClear(url) {
        const texture = loader.load(url);
        texture.minFilter = THREE.LinearFilter;
        texture.magFilter = THREE.LinearFilter;
        texture.anisotropy = renderer.capabilities.getMaxAnisotropy();
        texture.encoding = THREE.sRGBEncoding;
        return texture;
    }

    const materials = [
        new THREE.MeshPhongMaterial({ color: colorHex }), // right
        new THREE.MeshPhongMaterial({ color: colorHex }), // left
        new THREE.MeshPhongMaterial({ color: colorHex }), // top
        new THREE.MeshPhongMaterial({ color: colorHex }), // bottom
        frontImage
            ? new THREE.MeshPhongMaterial({ map: loadTextureClear(frontImage) })
            : new THREE.MeshPhongMaterial({ color: colorHex }), // front
        backImage
            ? new THREE.MeshPhongMaterial({ map: loadTextureClear(backImage) })
            : new THREE.MeshPhongMaterial({ color: colorHex }) // back
    ];

    cabinetMesh = new THREE.Mesh(geometry, materials);
    cabinetGroup.add(cabinetMesh);

    // === Center camera on the cabinet ===
    const box = new THREE.Box3().setFromObject(cabinetMesh);
    const center = new THREE.Vector3();
    box.getCenter(center);
    controls.target.copy(center);
    controls.update();


    // === Optional: Add labels ===
    createLabel(`CABINET HEIGHT: ${height}`, new THREE.Vector3(width * scale, 0, 0));
    createLabel(`CABINET WIDTH: ${width}`, new THREE.Vector3(0, height * scale, 0));
    createLabel(`CABINET DEPTH: ${depth}`, new THREE.Vector3(0, 0, depth * scale / 0.4));

    // === Optional: Add lines for dimension guides ===
    scene.add(
        new THREE.Line(
            new THREE.BufferGeometry().setFromPoints([
                new THREE.Vector3(0, 0, 0),
                new THREE.Vector3(width * scale, 0, 0)
            ]),
            new THREE.LineBasicMaterial({ color: 0x000000 })
        ),
        new THREE.Line(
            new THREE.BufferGeometry().setFromPoints([
                new THREE.Vector3(0, 0, 0),
                new THREE.Vector3(0, height * scale, 0)
            ]),
            new THREE.LineBasicMaterial({ color: 0x000000 })
        ),
        new THREE.Line(
            new THREE.BufferGeometry().setFromPoints([
                new THREE.Vector3(0, 0, 0),
                new THREE.Vector3(0, 0, depth * scale)
            ]),
            new THREE.LineBasicMaterial({ color: 0x000000 })
        )
    );

    renderer.render(scene, camera);
  }

    function addPosts(postShape, postWidth, postTotalHeight, postSpacing, postColor, cabinetWidth, cabinetHeight) {
    const scale = 0.3;

    // Clear any existing posts from the group
    while (postGroup.children.length > 0) {
        const child = postGroup.children.pop();
        postGroup.remove(child);
    }

    // Calculate the vertical center of the cabinet
    const cabinetCenterY = cabinetHeight * scale / 2;

    // Adjust post spacing: reduce to half for centering
    const reducedSpacing = postSpacing * 0.5;

    // Position the post so the top of the post aligns with the top of the cabinet
    const postTopY = cabinetCenterY + (postTotalHeight * scale) / 2;

    console.log("Cabinet Height (scaled):", cabinetHeight * scale);
    console.log("Cabinet Center Y:", cabinetCenterY);
    console.log("Scaled Post Height:", postTotalHeight * scale);
    console.log("Post Top Y:", postTopY);

    // Create geometry depending on post shape
    let postGeometry;
    if (postShape === "Round") {
        console.log('Round shape::::::::::::::::::::::::');
        // Cylinder for round posts
        postGeometry = new THREE.CylinderGeometry(
            (postWidth / 2) * scale,  // top radius
            (postWidth / 2) * scale,  // bottom radius
            postTotalHeight * scale,  // height
            32                        // segments
        );
        console.log("Post Shape: Round");
    } else {
        console.log('Square shape::::::::::::::::::::::::');
        // 🔲 Box for square posts
        postGeometry = new THREE.BoxGeometry(
            postWidth * scale,
            postTotalHeight * scale,
            postWidth * scale
        );
        console.log("Post Shape: Square");
    }

    // Create material with color
    const postMaterial = new THREE.MeshPhongMaterial({ color: postColor });

    // Function to create a post at a given X offset
    function createPost(xOffset) {
        const post = new THREE.Mesh(postGeometry, postMaterial);

        // Set post position
        const postY = postTopY - postTotalHeight * scale;
        post.position.set(xOffset, postY, 0);
        postGroup.add(post);

        console.log(`🪵 Created post at X: ${xOffset}, Y: ${postY}, Z: 0`);
    }

    // Create two posts: left and right
    createPost(-reducedSpacing / 2); // Left post
    createPost(+reducedSpacing / 2); // Right post

    // Render the updated scene
    renderer.render(scene, camera);
}

    // === 8. Add Footings ===
    function addFootings(positions, postTotalHeight, diameter, depth) {
    const scale = 0.3;

    // Clear previous footings
    while (footingGroup.children.length > 0) {
        const child = footingGroup.children.pop();
        footingGroup.remove(child);
    }

    // Loop through each post position
    positions.forEach(pos => {
        const postHeightScaled = postTotalHeight * scale;
        const depthScaled = depth * scale;
        const colorHex = "#d5d5d5";
        // Bottom of the post (since pos.y is center)
        const postBottomY = pos.y - postHeightScaled / 2;

        // Create the footing geometry
        const footing = new THREE.Mesh(
            new THREE.CylinderGeometry(diameter / 2 * scale, diameter / 2 * scale, depthScaled, 32),
            new THREE.MeshPhongMaterial({ color: colorHex })
        );

        // Position footing so top sits exactly at bottom of post
        footing.position.set(pos.x, postBottomY - depthScaled / 2 + 0.20, pos.z);

        // Add to group
        footingGroup.add(footing);

        // Debug log
        console.log(`Footing placed at y = ${postBottomY - depthScaled / 2}, under post at y = ${pos.y}`);
    });

    renderer.render(scene, camera);
}


    // === 9. Baseplate ===
    function createBaseplate(width, length, thickness, anchorDia, anchorCount, embedment, cabinetHeight, postTotalHeight, footingDepth) {
        const scale = 0.3;
        if (baseplateMesh) {
            baseplateGroup.remove(baseplateMesh);
        }
        const geometry = new THREE.BoxGeometry(width * scale, thickness * scale, length * scale);
        const material = new THREE.MeshPhongMaterial({ color: "#888888" });
        baseplateMesh = new THREE.Mesh(geometry, material);

        const cabinetCenterY = cabinetHeight * scale / 2;
        const postBottomY = cabinetCenterY - postTotalHeight * scale;
        const footingTopY = postBottomY + footingDepth * scale;
        const baseplateY = footingTopY + (thickness * scale) / 2;

        baseplateMesh.position.set(0, baseplateY, 0);
        baseplateGroup.add(baseplateMesh);

        addAnchorHoles(baseplateMesh, anchorDia, anchorCount, scale);
        renderer.render(scene, camera);

        return baseplateMesh;
    }


    function addAnchorHoles(baseplate, anchorDia, anchorCount, scale) {
        const holeRadius = (anchorDia / 2) * scale;
        const holeDepth = 0.2 * scale;
        const angleStep = (Math.PI * 2) / anchorCount;

        for (let i = 0; i < anchorCount; i++) {
            const angle = i * angleStep;
            const xOffset = Math.cos(angle) * (baseplate.geometry.parameters.width / 2 - holeRadius);
            const zOffset = Math.sin(angle) * (baseplate.geometry.parameters.depth / 2 - holeRadius);
            const hole = createAnchorHole(xOffset, zOffset, holeRadius, holeDepth);
            baseplate.add(hole);
        }
    }

    function createAnchorHole(xOffset, zOffset, radius, depth) {
        const holeGeometry = new THREE.CylinderGeometry(radius, radius, depth, 32);
        const holeMaterial = new THREE.MeshBasicMaterial({ color: 0x000000 });
        const hole = new THREE.Mesh(holeGeometry, holeMaterial);
        hole.position.set(xOffset, 0, zOffset);
        return hole;
    }


    function setCamera(view) {
    const distance = 5;

    switch (view) {
        case 'front':
            camera.position.set(0, 0, distance);
            break;
        case 'back':
            camera.position.set(0, 0, -distance);
            break;
        case 'left':
            camera.position.set(-distance, 0, 0);
            break;
        case 'right':
            camera.position.set(distance, 0, 0);
            break;
        case 'top':
            camera.position.set(0, distance, 0);
            break;
        case 'bottom':
            camera.position.set(0, -distance, 0);
            break;
        case 'fl-top': // Front-left top
            camera.position.set(-distance, distance, distance);
            break;
        case 'bl-top': // Back-left top
            camera.position.set(-distance, distance, -distance);
            break;
        case 'fr-top': // Front-right top
            camera.position.set(distance, distance, distance);
            break;
        case 'home':
            camera.position.set(0, distance, distance); // Top-front view
            break;
        default:
            return;
    }
    camera.lookAt(0, 0, 0);
    renderer.render(scene, camera);
}


    // === 10. GLTF Export ===
    function exportGLTF() {
        const exportGroup = new THREE.Group();
        exportGroup.add(cabinetGroup);
        exportGroup.add(postGroup);
        exportGroup.add(baseplateMesh);

        new THREE.GLTFExporter().parse(exportGroup, result => {
            const blob = new Blob([result], { type: 'application/octet-stream' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'complete-model.glb';
            link.click();
        }, { binary: true });
    }

    // === 11. Animate Loop ===
    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    }
    animate();

    // DOM Loaded Event Listener
    document.addEventListener("DOMContentLoaded", () => {
        const inputs = {
        width: document.getElementById("cabinet-width"),
        height: document.getElementById("cabinet-height"),
        depth: document.getElementById("cabinet-depth"),
        frontImage: document.getElementById("front-image-input"),
        backImage: document.getElementById("back-image-input"),
        color: document.getElementById("cabinet-color"),

        // Posts inputs
        postShape: document.getElementById("post-shape"),
        postWidth: document.getElementById("post-width"),
        postTotalHeight: document.getElementById("post-total-height"),
        postSpacing: document.getElementById("post-spacing"),
        postColor: document.getElementById("post-color"),
        postDepth: document.getElementById("post-depth"),

        // Footing inputs
        footingType: document.getElementById("footing-type"),
        footingDiameter: document.getElementById("footing-diameter"),
        footingDepth: document.getElementById("footing-depth"),

        // Baseplate inputs
        baseplateWidth: document.getElementById("baseplate-width"),
        baseplateLength: document.getElementById("baseplate-length"),
        baseplateThickness: document.getElementById("baseplate-thickness"),
        anchorDiameter: document.getElementById("anchor-diameter"),
        anchorCount: document.getElementById("anchor-count"),
        embedment: document.getElementById("embedment"),
    };

        // Add event listeners to inputs
        Object.values(inputs).forEach(input => {
            if (input) {
                input.addEventListener("input", () => {
                    // Cabinet values
                    const w = parseFloat(inputs.width.value) || 0;
                    const h = parseFloat(inputs.height.value) || 0;
                    const d = parseFloat(inputs.depth.value) || 0;
                    const frontImage = inputs.frontImage.files?.length > 0 ? URL.createObjectURL(inputs.frontImage.files[0]) : "";
                    const backImage = inputs.backImage.files?.length > 0 ? URL.createObjectURL(inputs.backImage.files[0]) : "";
                    const color = inputs.color.value || "#c5e4d4";
                    console.log('cabinet color:::::',color);


                    // Posts values
                    const postShape = inputs.postShape?.value || "Round";
                    const postWidth = parseFloat(inputs.postWidth?.value) || 0.1;
                    const postTotalHeight = parseFloat(inputs.postTotalHeight?.value) || 0;
                    const postSpacing = parseFloat(inputs.postSpacing?.value) || 0;
                    const postColor = inputs.postColor?.value || "#9b9b9b";
                    const postDepth = parseFloat(inputs.postDepth?.value) || 0;

                
                    // Footing values
                    const footingDiameter = parseFloat(inputs.footingDiameter?.value) || 0;
                    const footingDepth = parseFloat(inputs.footingDepth?.value) || 0;


                    // Baseplate values
                    const baseplateWidth = parseFloat(inputs.baseplateWidth?.value) || 0;
                    const baseplateLength = parseFloat(inputs.baseplateLength?.value) || 0;
                    const baseplateThickness = parseFloat(inputs.baseplateThickness?.value) || 0;
                    const anchorDia = parseFloat(inputs.anchorDiameter?.value) || 0;
                    const anchorCount = parseInt(inputs.anchorCount?.value) || 0;
                    const embedment = parseFloat(inputs.embedment?.value) || 0;

                    if (w > 0 && h > 0 && d > 0) {
                        createCabinet(w, h, d, frontImage, backImage ,color,postTotalHeight);
                    }

          
                    if (postWidth > 0 && postTotalHeight > 0 && postSpacing > 0) {
                        addPosts(postShape, postWidth, postTotalHeight, postSpacing, postColor, w, h);
                    }

                    if (footingDiameter > 0 && footingDepth > 0) {
                        const scale = 0.3;
                        const cabinetCenterY = h * scale / 2;
                        const postTopY = cabinetCenterY + postTotalHeight * scale / 2;
                        const postBottomY = postTopY - postTotalHeight * scale;

                        const reducedSpacing = postSpacing * 0.5;
                        const footingY = postBottomY - footingDepth * scale / 2;

                        const positions = [
                            { x: -reducedSpacing / 2, y: footingY, z: 0 },
                            { x: +reducedSpacing / 2, y: footingY, z: 0 }
                        ];

                        addFootings(positions, postTotalHeight, footingDiameter, footingDepth);
                    }

                    if (baseplateWidth > 0 && baseplateLength > 0 && baseplateThickness > 0) {
                        createBaseplate(baseplateWidth, baseplateLength, baseplateThickness, anchorDia, anchorCount, embedment, h,postTotalHeight,footingDepth);
                    }

                    // Re-render
                    if (typeof renderer !== "undefined" && typeof scene !== "undefined" && typeof camera !== "undefined") {
                        renderer.render(scene, camera);
                    }
                });
            }
        });
    });

    
    // === 14. Export Button Creation ===
    const exportButton = document.createElement('button');
    exportButton.textContent = 'Download 3D (GLB)';
    exportButton.style.cssText = 'background-color: #28a745; color: #fff; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; max-w-[200px]';
    exportButton.onclick = exportGLTF;
    document.getElementById("3d-modal-container").appendChild(exportButton);

    // === 15. Responsive Resize ===
    window.addEventListener('resize', () => {
        const width = container.clientWidth;
        const height = container.clientHeight;
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
    });
    </script>
@endsection
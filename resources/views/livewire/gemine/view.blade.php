<div>
	
	<!--Gemini Content-->
	<div class="card chat-container {{ $showChat ? '' : 'hide' }}" id="chatContainer">
		<div class="card-header chat-header">
			<h5><i class='bx bx-rocket mt-n1'></i> Gemini IA</h5>
			<button id="closeChat" wire:click="toggleChat" class="btn btn-sm btn-danger"><i class='bx bx-x'></i></button>
		</div>
		<div class="chat-body" id="chatBody">

			@forelse ($chat as $row)

			<div class="ai-message my-2">
				<div class="pt-2 px-2">
					<div class="d-flex justify-content-start">
						<img src="{{ asset('static/assets/img/others/gemini.jpg') }}" alt class="w-px-20 h-25 rounded-circle"/>
						<p class="mx-2"><strong>Gemini</strong></p>
					</div>
				</div>

				<div class="mx-1 py-1">
					<p>
						{{$row->respuesta}}
					</p>
				</div>
			</div>

			<div class="user-message my-2">
				<div class="pt-2 px-2">
					<div class="d-flex justify-content-end">
						<p class="mx-2"><strong>{{$row->user->name}} {{$row->user->lastName}}</strong></p>
						<img src="{{ $row->user->image ? Storage::url($row->user->image) : asset('static/assets/img/avatars/8.png') }}" alt class="w-px-20 h-25 rounded-circle"/>
					</div>
				</div>

				<p class="mx-1 py-1">
					{{ $row->pregunta }}
				</p>
			</div>

			@empty

				<div class="d-flex justify-content-center" style="margin-top:100px;"> 
					<img src="{{ asset('static/assets/img/others/gemini.jpg') }}" class="w-px-20 h-50 rounded-circle mt-1">
					<h5 class="mt">¡Interactua con Gemini IA!</h5>
				</div>

			@endforelse
     </div>

        <form class="chat-input" wire:submit.prevent="procesarMensaje">
            <input type="text" id="messageInput" class="form-control" placeholder="Escribe tu mensaje..." wire:model="pregunta">
            <button id="sendMessage" wire:click="procesarMensaje()" class="btn btn-primary mx-2"><i class='bx bx-paper-plane'></i></button>
        </form>
	</div>


	<button id="openChat" wire:click="toggleChat" class="btn btn-primary {{ $showChat ? 'd-none' : '' }}"><strong><i class='bx bx-planet mt-n1'></i> Gemini IA</strong></button>
	<!--End Gemine Content -->

</div>

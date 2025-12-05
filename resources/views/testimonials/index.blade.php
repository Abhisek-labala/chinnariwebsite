@extends('layouts.guest')

@section('content')
<div style="background: var(--dark); color: white; padding: 100px 0 50px; text-align: center;">
    <h1>Testimonials</h1>
    <p>What Our Patients Say</p>
</div>

<section class="section">
    <div class="container">
        <div style="display: flex; gap: 50px; flex-wrap: wrap;">
            
            <!-- Submission Form -->
            <div style="flex: 1; min-width: 300px;">
                <form action="{{ route('testimonials.store') }}" method="POST" style="background: white; padding: 40px; border-radius: 15px; box-shadow: var(--shadow);">
                    @csrf
                    @if(session('success'))
                        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 style="margin-bottom: 20px;">Share Your Experience</h3>
                    
                    <div class="form-group">
                        <label>Your Rating:</label>
                        <div class="rating-input">
                            <input type="radio" name="rating" value="5" id="star5" checked><label for="star5">☆</label>
                            <input type="radio" name="rating" value="4" id="star4"><label for="star4">☆</label>
                            <input type="radio" name="rating" value="3" id="star3"><label for="star3">☆</label>
                            <input type="radio" name="rating" value="2" id="star2"><label for="star2">☆</label>
                            <input type="radio" name="rating" value="1" id="star1"><label for="star1">☆</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="designation" class="form-control" placeholder="Designation (Optional)">
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="4" placeholder="Your Feedback" required></textarea>
                    </div>
                    <button type="submit" class="btn" style="width: 100%;">Submit Testimonial</button>
                </form>
            </div>
            
            <!-- List -->
            <div style="flex: 2; min-width: 300px;">
                <h3 style="margin-bottom: 30px;">What our patients say</h3>
                <div class="grid" style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                    @forelse($testimonials as $testimonial)
                    <div class="card" style="padding: 30px; display: flex; gap: 20px; align-items: flex-start;">
                        <div style="font-size: 3rem; color: #eee; min-width: 50px;">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div>
                            <p style="font-style: italic; color: #555; margin-bottom: 15px;">"{{ $testimonial->message }}"</p>
                            
                            <div style="margin-bottom: 10px; color: #ffc107;">
                                @for($i=1; $i<=5; $i++)
                                    @if($i <= $testimonial->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>

                            <h4 style="margin-bottom: 0;">{{ $testimonial->name }}</h4>
                            @if($testimonial->designation)
                                <p style="font-size: 0.9rem; color: var(--primary);">{{ $testimonial->designation }}</p>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p>No testimonials yet. Be the first to share your experience!</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

<div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
    <div class="flex justify-center">

        <div class="max-w-md mx-auto text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
            <header class="mb-8">
                <h1 class="text-2xl font-bold mb-1">Mobile Phone Verification</h1>
                <p class="text-[15px] text-slate-500">Enter the 4-digit verification code that was sent to your phone number.</p>
            </header>
            <form id="otp-form">
                <div class="flex items-center justify-center gap-3">

                     <h2 class="w-20 h-10 p-3 rounded-lg font-bold">{{$otp}}</h2>

                </div>
                <div class="max-w-[260px] mx-auto mt-4">
                    <button type="submit"
                            class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-indigo-500 px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150">Verify
                        Account</button>
                </div>
            </form>
            <div class="text-sm text-slate-500 mt-4">Didn't receive code? <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Resend</a></div>
        </div>
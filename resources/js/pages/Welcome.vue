<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-50 p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
        <header class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
            <nav class="flex items-center justify-between gap-4">
                <p>Logo</p>
                <div class="flex gap-4">
                    <Link v-if="$page.props.auth.user" :href="route('dashboard.index')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                    Dashboard
                    </Link>
                    <template v-else>
                        <Link :href="route('login')"
                            class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]">
                        Log in
                        </Link>
                        <Link :href="route('register')"
                            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                        Register
                        </Link>
                    </template>
                </div>
            </nav>
        </header>
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
            <main class="flex flex-col w-full max-w-[335px] overflow-hidden rounded-lg lg:max-w-4xl">




                <div>
                    <section class="pt-12 pb-12 sm:pb-16 lg:pt-8">
                        <div class="mx-auto max-w-7xl ">
                            <div
                                class="grid max-w-lg grid-cols-1 mx-auto lg:max-w-full lg:items-center lg:grid-cols-2 gap-y-12 lg:gap-x-16">
                                <div>
                                    <div class="text-center lg:text-left">
                                        <h1
                                            class="text-4xl font-bold leading-tight text-gray-900 sm:text-5xl sm:leading-tight lg:leading-tight lg:text-6xl font-pj">
                                            A special credit card made for Developers.</h1>
                                        <p class="mt-2 text-lg text-gray-600 sm:mt-8 font-inter">Lorem ipsum dolor sit
                                            amet,
                                            consectetur adipiscing elit. Vehicula massa in enim luctus. Rutrum arcu.</p>

                                        <form action="#" method="POST" class="mt-8 sm:mt-10">
                                            <div
                                                class="relative p-2 sm:border sm:border-gray-400 group sm:rounded-xl sm:focus-within:ring-1 sm:focus-within:ring-gray-900 sm:focus-within:border-gray-900">
                                                <input type="email" name="" id="" placeholder="Enter email address"
                                                    class="block w-full px-4 py-4 text-gray-900 placeholder-gray-900 bg-transparent border border-gray-400 outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900 rounded-xl sm:border-none sm:focus:ring-0 sm:focus:border-transparent" />
                                                <div
                                                    class="mt-4 sm:mt-0 sm:absolute sm:inset-y-0 sm:right-0 sm:flex sm:items-center sm:pr-2">
                                                    <button type="submit"
                                                        class="inline-flex px-6 py-3 text-lg font-bold text-white transition-all duration-200 bg-gray-900 rounded-lg focus:outline-none focus:bg-gray-600 font-pj hover:bg-gray-600">Get
                                                        Free Card</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div
                                        class="flex items-center justify-center mt-10 space-x-6 lg:justify-start sm:space-x-8">
                                        <div class="flex items-center">
                                            <p class="text-3xl font-medium text-gray-900 sm:text-4xl font-pj">2943</p>
                                            <p class="ml-3 text-sm text-gray-900 font-pj">Cards<br />Delivered</p>
                                        </div>

                                        <div class="hidden sm:block">
                                            <svg class="text-gray-400" width="16" height="39" viewBox="0 0 16 39"
                                                fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <line x1="0.72265" y1="10.584" x2="15.7226" y2="0.583975"></line>
                                                <line x1="0.72265" y1="17.584" x2="15.7226" y2="7.58398"></line>
                                                <line x1="0.72265" y1="24.584" x2="15.7226" y2="14.584"></line>
                                                <line x1="0.72265" y1="31.584" x2="15.7226" y2="21.584"></line>
                                                <line x1="0.72265" y1="38.584" x2="15.7226" y2="28.584"></line>
                                            </svg>
                                        </div>

                                        <div class="flex items-center">
                                            <p class="text-3xl font-medium text-gray-900 sm:text-4xl font-pj">$1M+</p>
                                            <p class="ml-3 text-sm text-gray-900 font-pj">Transaction<br />Completed</p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <img class="w-full"
                                        src="https://d33wubrfki0l68.cloudfront.net/d6f1462500f7670e0db6b76b35054a081679a5a0/0ce15/images/hero/5.1/illustration.png"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </section>
                </div>





                <section class="py-12 sm:py-16 lg:py-20">
                    <div class="mx-auto max-w-7xl">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold leading-tight text-gray-900 sm:text-4xl xl:text-5xl font-pj">
                                Make
                                every step user-centric</h2>
                            <p class="mt-4 text-base leading-7 text-gray-600 sm:mt-8 font-pj">Lorem ipsum dolor sit
                                amet,
                                consectetur adipis elit</p>
                        </div>

                        <div
                            class="grid grid-cols-1 mt-10 text-center sm:mt-16 sm:grid-cols-2 sm:gap-x-12 gap-y-12 md:grid-cols-3 md:gap-0 xl:mt-24">
                            <div class="md:p-8 lg:p-14">
                                <svg class="mx-auto" width="46" height="46" viewBox="0 0 46 46" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M45 29V23C45 10.85 35.15 1 23 1C10.85 1 1 10.85 1 23V29" stroke="#161616"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M13 29H1V41C1 43.209 2.791 45 5 45H13V29Z" fill="#D4D4D8" stroke="#161616"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M45 29H33V45H41C43.209 45 45 43.209 45 41V29Z" fill="#D4D4D8"
                                        stroke="#161616" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <h3 class="mt-12 text-xl font-bold text-gray-900 font-pj">Support</h3>
                                <p class="mt-5 text-base text-gray-600 font-pj">Lorem ipsum dolor sit amet, consectetur
                                    adipis
                                    elit. Sit enim nec, proin faucibus nibh et sagittis a. Lacinia purus ac amet.</p>
                            </div>

                            <div class="md:p-8 lg:p-14 md:border-l md:border-gray-200">
                                <svg class="mx-auto" width="46" height="46" viewBox="0 0 46 46" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27 27H19V45H27V27Z" stroke="#161616" stroke-width="2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 37H1V45H9V37Z" fill="#D4D4D8" stroke="#161616" stroke-width="2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M45 17H37V45H45V17Z" fill="#D4D4D8" stroke="#161616" stroke-width="2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5 17L15 7L23 15L37 1" stroke="#161616" stroke-width="2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M28 1H37V10" stroke="#161616" stroke-width="2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <h3 class="mt-12 text-xl font-bold text-gray-900 font-pj">Sales</h3>
                                <p class="mt-5 text-base text-gray-600 font-pj">Lorem ipsum dolor sit amet, consectetur
                                    adipis
                                    elit. Sit enim nec, proin faucibus nibh et sagittis a. Lacinia purus ac amet.</p>
                            </div>

                            <div class="md:p-8 lg:p-14 md:border-l md:border-gray-200">
                                <svg class="mx-auto" width="42" height="42" viewBox="0 0 42 42" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M41 1H1V41H41V1Z" stroke="#161616" stroke-width="2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M18 7H7V20H18V7Z" stroke="#161616" stroke-width="2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M18 26H7V35H18V26Z" stroke="#161616" stroke-width="2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M35 7H24V35H35V7Z" fill="#D4D4D8" stroke="#161616" stroke-width="2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <h3 class="mt-12 text-xl font-bold text-gray-900 font-pj">Onboarding</h3>
                                <p class="mt-5 text-base text-gray-600 font-pj">Lorem ipsum dolor sit amet, consectetur
                                    adipis
                                    elit. Sit enim nec, proin faucibus nibh et sagittis a. Lacinia purus ac amet.</p>
                            </div>

                            <div class="md:p-8 lg:p-14 md:border-t md:border-gray-200">
                                <svg class="mx-auto" width="42" height="42" viewBox="0 0 42 42" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.66667 25H6C3.23858 25 1 27.2386 1 30V37C1 39.7614 3.23858 42 6 42H36C38.7614 42 41 39.7614 41 37V30C41 27.2386 38.7614 25 36 25H31.8333C30.2685 25 29 26.2685 29 27.8333C29 29.3981 27.7315 30.6667 26.1667 30.6667H15.3333C13.7685 30.6667 12.5 29.3981 12.5 27.8333C12.5 26.2685 11.2315 25 9.66667 25Z"
                                        fill="#D4D4D8" />
                                    <path d="M9 9H33" stroke="#161616" stroke-width="2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 17H33" stroke="#161616" stroke-width="2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M1 25H13V31H29V25H41" stroke="#161616" stroke-width="2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M37 1H5C2.79086 1 1 2.79086 1 5V37C1 39.2091 2.79086 41 5 41H37C39.2091 41 41 39.2091 41 37V5C41 2.79086 39.2091 1 37 1Z"
                                        stroke="#161616" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <h3 class="mt-12 text-xl font-bold text-gray-900 font-pj">Product</h3>
                                <p class="mt-5 text-base text-gray-600 font-pj">Lorem ipsum dolor sit amet, consectetur
                                    adipis
                                    elit. Sit enim nec, proin faucibus nibh et sagittis a. Lacinia purus ac amet.</p>
                            </div>

                            <div class="md:p-8 lg:p-14 md:border-l md:border-gray-200 md:border-t">
                                <svg class="mx-auto" width="46" height="42" viewBox="0 0 46 42" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M30.562 18.4609C30.0511 17.9392 29.4292 17.5392 28.7426 17.2907C28.0559 17.0422 27.3221 16.9516 26.5956 17.0256C25.8692 17.0996 25.1687 17.3362 24.5462 17.718C23.9237 18.0998 23.3952 18.6169 23 19.2309C22.6049 18.6167 22.0764 18.0995 21.4539 17.7176C20.8315 17.3357 20.1309 17.099 19.4044 17.025C18.6779 16.951 17.944 17.0417 17.2573 17.2903C16.5706 17.5389 15.9488 17.939 15.438 18.4609C14.5163 19.4035 14.0002 20.6695 14.0002 21.9879C14.0002 23.3063 14.5163 24.5722 15.438 25.5149L23 33.1999L30.564 25.5159C31.485 24.5726 32.0004 23.3064 32 21.988C31.9997 20.6696 31.4835 19.4037 30.562 18.4609Z"
                                        fill="#D4D4D8" stroke="#161616" stroke-width="2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M41 41H5C3.93913 41 2.92172 40.5786 2.17157 39.8284C1.42143 39.0783 1 38.0609 1 37V1H17L22 9H45V37C45 38.0609 44.5786 39.0783 43.8284 39.8284C43.0783 40.5786 42.0609 41 41 41Z"
                                        stroke="#161616" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <h3 class="mt-12 text-xl font-bold text-gray-900 font-pj">Quality</h3>
                                <p class="mt-5 text-base text-gray-600 font-pj">Lorem ipsum dolor sit amet, consectetur
                                    adipis
                                    elit. Sit enim nec, proin faucibus nibh et sagittis a. Lacinia purus ac amet.</p>
                            </div>

                            <div class="md:p-8 lg:p-14 md:border-l md:border-gray-200 md:border-t">
                                <svg class="mx-auto" width="44" height="44" viewBox="0 0 44 44" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M25 7C34.941 7 43 15.059 43 25C43 34.941 34.941 43 25 43C15.059 43 7 34.941 7 25"
                                        stroke="#161616" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M19 1C9.059 1 1 9.059 1 19H19V1Z" fill="#D4D4D8" stroke="#161616"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <h3 class="mt-12 text-xl font-bold text-gray-900 font-pj">Result</h3>
                                <p class="mt-5 text-base text-gray-600 font-pj">Lorem ipsum dolor sit amet, consectetur
                                    adipis
                                    elit. Sit enim nec, proin faucibus nibh et sagittis a. Lacinia purus ac amet.</p>
                            </div>
                        </div>
                    </div>
                </section>






                <footer>
                    <div class="w-full mx-auto max-w-screen-xl py-4 md:flex md:items-center md:justify-between">
                        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 All Rights
                            Reserved.
                        </span>
                        <ul
                            class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                            <li>
                                <a href="#" class="hover:underline me-4 md:me-6">About</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Contact</a>
                            </li>
                        </ul>
                    </div>
                </footer>






            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>

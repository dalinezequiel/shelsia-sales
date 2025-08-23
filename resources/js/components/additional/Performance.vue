<template>
    <section id="about" class="py-14 md:px-20 lg:px-14 bg-[#121212]">
        <div class="container mx-auto px-4">
            <div class="mb-12">
                <!-- Heading -->
                <h2 class="text-purple-400 text-lg mb-2" data-aos="fade-down">
                    Sales
                </h2>
                <h3 class="mb-4 text-3xl font-bold text-white section-title" data-aos="fade-down">
                    Model performance evaluation metrics
                </h3>
                <p class="mb-8 max-w-3xl text-gray-400" data-aos="fade-down">
                    Essas métricas fornecem insights sobre o desempenho do modelo e ajudam a avaliar sua capacidade
                    preditiva, capacidade de generalização e qualidade geral.
                </p>

                <!-- About Cards Section -->
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Card 1 -->
                    <div class="rounded-lg border border-gray-800 bg-[#1A1A1A] py-4 text-center">
                        <h4 class="mb-0 text-3xl font-bold text-purple-400">10+</h4>
                        <p class="text-gray-400">r2_score</p>
                    </div>
                    <div class="rounded-lg border border-gray-800 bg-[#1A1A1A] py-4 text-center">
                        <h4 class="mb-0 text-3xl font-bold text-purple-400">10+</h4>
                        <p class="text-gray-400">mean_absolute_error</p>
                    </div>
                    <div class="rounded-lg border border-gray-800 bg-[#1A1A1A] p-4 text-center">
                        <h4 class="mb-0 text-3xl font-bold text-purple-400">10+</h4>
                        <p class="text-gray-400">mean_squared_error</p>
                    </div>
                    <div class="rounded-lg border border-gray-800 bg-[#1A1A1A] p-4 text-center">
                        <h4 class="mb-0 text-3xl font-bold text-purple-400">10+</h4>
                        <p class="text-gray-400">root_mean_squared_error</p>
                    </div>

                </div>
            </div>

            <!-- Buttons Section -->
            <div class="flex flex-col sm:flex-row items-center gap-4 mt-8" data-aos="fade-up">
                <a href="#team"
                    class="cursor-pointer rounded-full bg-purple-600 hover:bg-purple-700 text-white py-3 px-8">
                    Cancel
                </a>
            </div>
        </div>
    </section>
</template>
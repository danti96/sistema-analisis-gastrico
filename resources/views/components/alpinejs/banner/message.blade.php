<template x-if="message.status != null">
    <div>

        <template x-if="message.status >= 200 && message.status < 300">
            <div class="border w-full p-2 flex justify-between">
                <div class="p-2 w-full bg-green-300 cursor-pointer">
                    <span class="font-bold underline decoration-solid" x-text="message.message"></span>
                </div>
            </div>
        </template>
        <template x-if="message.status >= 400 && message.status < 500">
            <div class="border w-full p-2 flex justify-between">
                <div class="p-2 w-full bg-red-300 cursor-pointer">
                    <span class="font-bold underline decoration-solid" x-text="message.message"></span>
                </div>
            </div>
        </template>
        <template x-if="message.status >= 500">
            <div class="border w-full p-2 flex justify-between">
                <div class="p-2 w-full bg-yellow-300 cursor-pointer">
                    <span class="font-bold underline decoration-solid" x-text="message.message"></span>
                </div>
            </div>
        </template>

    </div>
</template>

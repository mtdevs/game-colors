<template>
    <div class="row" id="palettes-row">
        <div class="col-lg-3 col-md-4 col-sm-6 my-2" v-for="palette in palettes" v-bind:key="palette.id">
            <div class="palette-outer">
                <!--a color-->
                <div class="palette-color" v-bind:style="{backgroundColor: '#' + palette.colors[0]}"
                     @click="showPalette(palette)">
                    <div class="copy-color" @click="copyColor(palette.colors[0])">
                        <span>&#35</span>
                        <span>{{ palette.colors[0] }}</span>
                    </div>
                </div>
                <!--a color-->
                <div class="palette-color" v-bind:style="{backgroundColor: '#' + palette.colors[1]}"
                     @click="showPalette(palette)">
                    <div class="copy-color" @click="copyColor(palette.colors[1])">
                        <span>&#35</span>
                        <span>{{ palette.colors[1] }}</span>
                    </div>
                </div>
                <!--a color-->
                <div class="palette-color" v-bind:style="{backgroundColor: '#' + palette.colors[2]}"
                     @click="showPalette(palette)">
                    <div class="copy-color" @click="copyColor(palette.colors[2])">
                        <span>&#35</span>
                        <span>{{ palette.colors[2] }}</span>
                    </div>
                </div>
                <!--a color-->
                <div class="palette-color" v-bind:style="{backgroundColor: '#' + palette.colors[3]}"
                     @click="showPalette(palette)">
                    <div class="copy-color" @click="copyColor(palette.colors[3])">
                        <span>&#35</span>
                        <span>{{ palette.colors[3] }}</span>
                    </div>
                </div>
            </div>
            <div class="pt-2 d-flex justify-content-between align-items-center">
                <span class="text-secondary"><small>{{palette.name}}</small></span>
                <button class="btn btn-light btn-sm" @click="likePalette(palette)">&hearts; {{ palette.likes }}</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PalettesComponent",

    data() {
        return {
            palettes: [],
            paginationData: {},
        }
    },

    created() {
      this.getPalettes();
        window.addEventListener('scroll', this.handleScroll);
    },

    methods: {
        getPalettes(page = 1) {
            axios.get(`api/palettes?page=${page}`)
                .then(res => {
                    console.log(res.data);
                    this.palettes = res.data.data.map(p => {
                        return {
                            id: p.id,
                            name: p.palette_name,
                            colors: p.palette_colors.split(','),
                            likes: p.palette_likes,
                            created_at: p.created_at,
                        };
                    });
                    this.paginationData = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },

        showPalette(palette) {
            if (event.target !== event.currentTarget) return;
            console.log(palette)
        },

        copyColor(color) {
          console.log(color);
            $('body').append('<textarea id="myClickboard">' + color.toUpperCase() + '</textarea>');

            let copyText = document.getElementById('myClickboard');

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand('copy');

            copyText.remove();
        },

        likePalette(palette) {
            axios.put(`api/palettes/${palette.id}`)
                .then(res => {
                    console.log(res.data);
                   this.palettes = this.palettes.map(p => {
                       if (p.id === palette.id) {
                           p.likes += res.data.increase;
                       }
                       return p;
                   });
                })
                .catch(err => {
                    console.log(err);
                });
        },

        handleScroll(e) {
            if (
                (window.innerHeight + window.scrollY) >= document.body.offsetHeight
                && this.paginationData.current_page !== this.paginationData.last_page
            ) {
                axios.get(this.paginationData.next_page_url)
                    .then(res => {
                        console.log(res.data);
                        res.data.data.map(p => {
                            const palette = {
                                id: p.id,
                                name: p.palette_name,
                                colors: p.palette_colors.split(','),
                                likes: p.palette_likes,
                                created_at: p.created_at,
                            };
                            this.palettes.push(palette);
                        });
                        this.paginationData = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },

    },

    destroyed() {
        window.removeEventListener('scroll', this.handleScroll);
    },
}
</script>

<style scoped>

</style>

<template>
    <div class="wrapper">
        <div class="dwelling_card">
            <div class="top">
                <img class="w-100" :src="`/images/placeholder/1.png`" alt="">
            </div>
            <div class="bottom">
                <div class="left d-flex">
                    <div class="details">
                        <h1>{{apartment.name}}</h1>
                        <p>&euro;{{apartment.price}}</p>
                    </div>
                    <router-link :to="{name: 'show-apartment', params:{ slug: apartment.slug}}" class="card-link buy">
                        <!-- <div class="buy"> -->

                            <h3>Dettagli</h3>

                        <!-- </div> -->
                    </router-link>
                </div>
            </div>
        </div>
        <div class="inside">
            <div class="icon"><i class="fa-solid fa-circle-info"></i></div>
            <div class="contents">
                <div class="d-flex" v-for="perk in apartment.perks" :key="`perk-${perk.id}`">
                    <p v-html="perk.icon"></p>
                    <p class="ml-3">{{perk.name}}</p>
                </div>

                <div v-for="category in categories" :key="`category-${category.id}`">
                    <h3 v-if="category.id == apartment.category">{{category.name}}</h3>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'DwellingcardComp',
    props: { apartment: Object, categories: Array }
}
</script>

<style lang="scss" scoped>


.wrapper{
    background: white;
    max-width: 450px;
    height: 450px;
    position: relative;
    overflow: hidden;
    border-radius: 10px 10px 10px 10px;
    box-shadow: 0;
    transform: scale(0.95);
    transition: box-shadow 0.5s, transform 0.5s;
    &:hover{
        transform: scale(1);
        box-shadow: 5px 20px 30px rgba(0,0,0,0.2);
    }

  .dwelling_card{
    width:100%;
    height:100%;
    .top{
      height: 56%;
      width:100%;
    }
    .bottom{
      width: 200%;
      height: 44%;
      transition: transform 0.5s;
      &.clicked{
        transform: translateX(-50%);
      }
      h1{
          margin:0;
          padding:0;
      }
      p{
          margin:0;
          padding:0;
      }
      .left{
        height:100%;
        width: 50%;
        background: #BEB7A4;
        position:relative;
        float:left;
        .details{
          padding: 20px 10px 10px 20px;
          float: left;
          width: 70%;
            color: #00394B;
        }
        .buy{
            float:right;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30%;
            color: #00394B;
            background: #BEB7A4;
            transition: background 0.5s;
            border-left:solid thin rgba(0,0,0,0.1);

            i{
                font-size:30px;
                padding:30px;
                color: #254053;
                transition: transform 0.5s;
            }

            &:hover{
                background: #A3A1A4;
            }

            &:hover i{
                transform: translateY(5px);
                color:#00394B;
            }
        }
      }
      .right{
        width: 50%;
        background: #A6CDDE;
        color: white;
        float:right;
        height:200%;
        overflow: hidden;
        .details{
          padding: 20px;
          float: right;
          width: calc(70% - 40px);
        }
        .done{
          width: calc(30% - 2px);
          float:left;
          transition: transform 0.5s;
          border-right:solid thin rgba(255,255,255,0.3);
          height:50%;

          i{
            font-size:30px;
            padding:30px;
            color: white;
          }
        }
        .remove{
          width: calc(30% - 1px);
          clear: both;
          border-right:solid thin rgba(255,255,255,0.3);
          height:50%;
          background: #BC3B59;
          transition: transform 0.5s, background 0.5s;
          &:hover{
            background: #9B2847;
          }
          &:hover i{
            transform: translateY(5px);
          }
          i{
            transition: transform 0.5s;
            font-size:30px;
            padding:30px;
            color: white;
          }
        }
        &:hover{
          .remove, .done{
            transform: translateY(-100%);
          }
        }
      }
    }
  }

  .inside{
    z-index:9;
    background: #292f36;
    width:140px;
    height:140px;
    position: absolute;
    top: -70px;
    right: -70px;
    border-radius: 0px 0px 200px 200px;
    transition: all 0.5s, border-radius 2s, top 1s;
    overflow: hidden;
    .icon{
      position:absolute;
      right:85px;
      top:85px;
      color:white;
    //  filter: invert(15%) sepia(15%) saturate(614%) hue-rotate(172deg) brightness(97%) contrast(90%);
      opacity: 1;
    }
    &:hover{
      width:100%;
      right:0;
      top:0;
      border-radius: 0;
      height: 56%;
      .icon{
        opacity: 0;
        right:15px;
        top:15px;
      }
      .contents{
        opacity: 1;
        transform: scale(1);
        transform: translateY(0);
      }
    }
    .contents{
      padding: 5%;
      opacity: 0;
      transform: scale(0.5);
      transform: translateY(-200%);
      transition: opacity 0.2s, transform 0.8s;
      table{
        text-align:left;
        width:100%;
      }
      h1, p, table{
        color: white;
      }
      p{
        font-size:13px;
      }
    }
  }
}
</style>

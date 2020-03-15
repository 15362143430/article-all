import echarts from 'echarts';
import { piePatternSrc, bgPatternSrc } from './src';
import {httpGET} from '../http/index';

export async function pei_wenli(domID: any) {
    let {data:res} = await httpGET('articlestype');
    var dom: any = document.getElementById(domID);
    var myChart = echarts.init(dom);
    var app = {};
    var piePatternImg = new Image();
    piePatternImg.src = piePatternSrc;
    var bgPatternImg = new Image();
    bgPatternImg.src = bgPatternSrc;

    var itemStyle = {
        normal: {
            opacity: 0.7,
            color: {
                image: piePatternImg,
                repeat: 'repeat'
            },
            borderWidth: 3,
            borderColor: '#235894'
        }
    };
    var option:any = {
        backgroundColor: {
            image: bgPatternImg,
            repeat: 'repeat'
        },
        title: {
            text: '文章类型统计图',
            textStyle: {
                color: '#235894'
            }
        },
        tooltip: {},
        series: [{
            // name: 'pie',
            type: 'pie',
            selectedMode: 'single',
            selectedOffset: 30,
            clockwise: true,
            label: {
                fontSize: 18,
                color: '#235894'
            },
            labelLine: {
                lineStyle: {
                    color: '#235894'
                }
            },
            data: res.data,
            itemStyle: itemStyle
        }]
    };
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
}